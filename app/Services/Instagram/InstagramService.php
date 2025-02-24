<?php

namespace App\Services\Instagram;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;

class InstagramService
{
    protected string $baseUrl = 'https://graph.facebook.com/v18.0/';
    protected string $accessToken;
    protected string $instagramAccountId;

    public function __construct()
    {
        $this->accessToken = config('services.instagram.access_token','EAAEEZCs4k7i0BO07qs3Cz16ePL2O6hjPhRTmaP7DS99HltoTHOS1AhKlrLvbOIif1ZAwYotob3ZCxEN30MbaRalD5Ot4MZBNrZCgGH8ZA3UmwIAnK8QJlpKbSmFZA0E8VPsupi7K02u40WVbBx34ZBlyntskOBHsqALzPVo4yFdADMgwtmjVBefKR071');
        $this->instagramAccountId = config('services.instagram.account_id','17841435196633344');
    }

    /**
     * ارسال تک پست به اینستاگرام
     */
    public function createPost(string $imageUrl, string $caption): array
    {
        try {
            // مرحله 1: ایجاد media container
            $containerId = $this->createMediaContainer($imageUrl, $caption);

            // مرحله 2: بررسی وضعیت آپلود
            $this->waitForMediaProcessing($containerId);

            // مرحله 3: انتشار پست
            $publishedPost = $this->publishMedia($containerId);

            return [
                'success' => true,
                'post_id' => $publishedPost['id'],
                'message' => 'پست با موفقیت در اینستاگرام منتشر شد'
            ];

        } catch (\Exception $e) {
            Log::error('خطا در ارسال پست به اینستاگرام: ' . $e->getMessage());

            return [
                'success' => false,
                'message' => 'خطا در ارسال پست به اینستاگرام',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * ارسال پست چند رسانه‌ای به اینستاگرام
     * @param array $mediaItems آرایه‌ای از آدرس‌های فایل‌های رسانه‌ای
     * @param string $caption کپشن پست
     */
    public function createCarouselPost(array $mediaItems, string $caption): array
    {
        try {
            // مرحله 1: آپلود همه media ها و دریافت شناسه‌های آنها
            $mediaIds = [];
            foreach ($mediaItems as $mediaItem) {
                $containerId = $this->createMediaContainer(
                    $mediaItem['url'],
                    '',  // کپشن خالی برای هر آیتم
                    $mediaItem['type'] ?? 'IMAGE'
                );
                $this->waitForMediaProcessing($containerId);
                $mediaIds[] = $containerId;
            }

            // مرحله 2: ایجاد carousel container
            $carouselContainer = $this->createCarouselContainer($mediaIds, $caption);

            // مرحله 3: انتشار carousel
            $publishedPost = $this->publishMedia($carouselContainer);

            return [
                'success' => true,
                'post_id' => $publishedPost['id'],
                'message' => 'پست چند رسانه‌ای با موفقیت منتشر شد'
            ];

        } catch (\Exception $e) {
            Log::error('خطا در ارسال پست چند رسانه‌ای: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'خطا در ارسال پست چند رسانه‌ای',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * ارسال ویدیو به اینستاگرام
     * @param string $videoUrl آدرس ویدیو
     * @param string $caption کپشن پست
     * @param string $type نوع ویدیو (VIDEO یا REELS)
     */
    public function createVideoPost(string $videoUrl, string $caption, string $type = 'VIDEO'): array
    {
        try {
            // مرحله 1: ایجاد container برای ویدیو
            $containerId = $this->createMediaContainer($videoUrl, $caption, $type);

            // مرحله 2: بررسی وضعیت آپلود (برای ویدیو زمان بیشتری نیاز است)
            $this->waitForMediaProcessing($containerId, 30); // تعداد تلاش‌های بیشتر

            // مرحله 3: انتشار ویدیو
            $publishedPost = $this->publishMedia($containerId);

            return [
                'success' => true,
                'post_id' => $publishedPost['id'],
                'message' => $type === 'REELS' ? 'ریلز با موفقیت منتشر شد' : 'ویدیو با موفقیت منتشر شد'
            ];

        } catch (\Exception $e) {
            Log::error("خطا در ارسال {$type}: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "خطا در ارسال {$type}",
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * ایجاد container برای media با پشتیبانی از انواع مختلف
     */
    protected function createMediaContainer(string $mediaUrl, string $caption, string $mediaType = 'IMAGE'): string
    {
        $params = [
            'access_token' => $this->accessToken,
            'caption' => $caption,
        ];

        switch ($mediaType) {
            case 'VIDEO':
            case 'REELS':
                $params['media_type'] = $mediaType;
                $params['video_url'] = $mediaUrl;
                break;
            default:
                $params['image_url'] = $mediaUrl;
        }

        $response = Http::post($this->baseUrl . $this->instagramAccountId . '/media', $params);

        if ($response->failed()) {
            throw new RequestException($response);
        }

        $data = $response->json();
        return $data['id'];
    }

    /**
     * ایجاد carousel container
     */
    protected function createCarouselContainer(array $mediaIds, string $caption): string
    {
        $response = Http::post($this->baseUrl . $this->instagramAccountId . '/media', [
            'media_type' => 'CAROUSEL',
            'children' => $mediaIds,
            'caption' => $caption,
            'access_token' => $this->accessToken
        ]);

        if ($response->failed()) {
            throw new RequestException($response);
        }

        $data = $response->json();
        return $data['id'];
    }

    /**
     * بررسی وضعیت پردازش media
     */
    protected function waitForMediaProcessing(string $containerId, int $maxAttempts = 10): void
    {
        $attempts = 0;
        $validStatusCodes = ['FINISHED', 'PUBLISHED', 'READY'];

        do {
            $response = Http::get($this->baseUrl . $containerId, [
                'fields' => 'status_code',
                'access_token' => $this->accessToken
            ]);

            $data = $response->json();

            if (in_array($data['status_code'], $validStatusCodes)) {
                return;
            }

            if ($data['status_code'] === 'ERROR') {
                throw new \Exception('خطا در پردازش رسانه: ' . ($data['error_message'] ?? 'خطای نامشخص'));
            }

            $attempts++;
            sleep(3); // افزایش زمان انتظار برای ویدیوها

        } while ($attempts < $maxAttempts);

        throw new \Exception('تایم‌اوت در پردازش رسانه');
    }

    /**
     * انتشار media در اینستاگرام
     */
    protected function publishMedia(string $containerId): array
    {
        $response = Http::post($this->baseUrl . $this->instagramAccountId . '/media_publish', [
            'creation_id' => $containerId,
            'access_token' => $this->accessToken
        ]);

        if ($response->failed()) {
            throw new RequestException($response);
        }

        return $response->json();
    }
}
