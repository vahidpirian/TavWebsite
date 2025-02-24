<?php

namespace App\Services\LinkedIn;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;

class LinkedInService
{
    protected string $baseUrl = 'https://api.linkedin.com/rest/';
    protected string $accessToken;
    protected string $authorUrn;

    public function __construct()
    {
        $this->accessToken = config('services.linkedin.access_token', 'AQUNLBSe7OKZiBZ2SdG2qpShSu_XePUoitdqIK4x-1YzsjnWD8LGX4Su6E3KSmMUPbPTZZTmiWbXK7PF2hcnYeW1WgBG6jAVnemc_RO9UbHBtVMMtvlgNXxceLRiBoLrVMVPs1umXr-Tw7tyZ4TGhqmgS49IQGxglYPp6Itjr50jgCpWr2LfEG08_Mck2djToeGkZDAyn_6y3X8ZWeVVxe99JoFG9aWG_5kU5242PrX_Ero-7PUmCHQ_P4JX5rFxK1b7o5WKLR2Hrgz_Cp2Ida4Sei2c6CGA-PVWsnfmE4XF-VBFh96DlReP_m7AzAjN6y-zO8mM3ilZnWf4fUfzH94NeOKpdw');
        $this->authorUrn = config('services.linkedin.author_urn', 'urn:li:person:MaH8_9ZgRq');
    }

    /**
     * ارسال پست متنی به لینکدین
     * @param string $text متن پست
     * @return array نتیجه عملیات
     */
    public function createTextPost(string $text): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'LinkedIn-Version' => '202502',
                'X-Restli-Protocol-Version' => '2.0.0',
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->post($this->baseUrl . 'posts', [
                'author' => $this->authorUrn,
                'commentary' => $text,
                'visibility' => 'PUBLIC',
                'distribution' => [
                    'feedDistribution' => 'MAIN_FEED',
                    'targetEntities' => [],
                    'thirdPartyDistributionChannels' => []
                ],
                'lifecycleState' => 'PUBLISHED',
                'isReshareDisabledByAuthor' => false
            ]);

            if ($response->failed()) {
                throw new RequestException($response);
            }

            $postId = $response->header('X-RestLi-Id');

            return [
                'success' => true,
                'post_id' => $postId,
                'message' => 'پست با موفقیت در لینکدین منتشر شد',
            ];
        } catch (\Exception $e) {
            Log::error('خطا در ارسال پست متنی به لینکدین: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'خطا در ارسال پست متنی به لینکدین',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * آپلود عکس به لینکدین
     * @param string $imagePath مسیر فایل عکس توی سرور
     * @return string mediaUrn
     */
    protected function uploadImage(string $imagePath): string
    {
        try {
            // مرحله 1: درخواست آپلود و گرفتن uploadUrl
            $initResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'LinkedIn-Version' => '202502',
                'X-Restli-Protocol-Version' => '2.0.0',
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . 'images?action=initializeUpload', [
                'initializeUploadRequest' => [
                    'owner' => $this->authorUrn,
                ]
            ]);

            if ($initResponse->failed()) {
                throw new RequestException($initResponse);
            }

            $initData = $initResponse->json();
            $uploadUrl = $initData['value']['uploadUrl'];
            $mediaUrn = $initData['value']['image'];

            // مرحله 2: آپلود عکس به uploadUrl
            $fileContent = file_get_contents($imagePath);
            $mimeType = mime_content_type($imagePath) ?: 'image/jpeg'; // تشخیص فرمت
            $uploadResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => $mimeType,
            ])->withBody($fileContent, $mimeType)->put($uploadUrl);

            if ($uploadResponse->failed()) {
                throw new \Exception('خطا در آپلود عکس: ' . $uploadResponse->body());
            }

            return $mediaUrn; // مثل urn:li:image:123456789
        } catch (\Exception $e) {
            Log::error('خطا در آپلود عکس به لینکدین: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * ارسال پست با عکس به لینکدین
     * @param string $text متن پست
     * @param string $imagePath مسیر فایل عکس
     * @return array نتیجه عملیات
     */
    public function createImagePost(string $text, string $imagePath): array
    {
        try {
            // آپلود عکس و گرفتن mediaUrn
            $mediaUrn = $this->uploadImage($imagePath);

            // ارسال پست
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'LinkedIn-Version' => '202502',
                'X-Restli-Protocol-Version' => '2.0.0',
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . 'posts', [
                'author' => $this->authorUrn,
                'commentary' => $text,
                'visibility' => 'PUBLIC',
                'distribution' => [
                    'feedDistribution' => 'MAIN_FEED',
                    'targetEntities' => [],
                    'thirdPartyDistributionChannels' => []
                ],
                'content' => [
                    'media' => [
                        'id' => $mediaUrn
                    ]
                ],
                'lifecycleState' => 'PUBLISHED',
                'isReshareDisabledByAuthor' => false
            ]);

            if ($response->failed()) {
                throw new RequestException($response);
            }

            $postId = $response->header('X-RestLi-Id');

            return [
                'success' => true,
                'post_id' => $postId,
                'message' => 'پست با عکس با موفقیت در لینکدین منتشر شد',
            ];
        } catch (\Exception $e) {
            Log::error('خطا در ارسال پست با عکس به لینکدین: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'خطا در ارسال پست با عکس به لینکدین',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * ارسال پست با لینک به لینکدین
     * @param string $text متن پست
     * @param string $url لینک
     * @param string|null $title عنوان لینک (اختیاری)
     * @param string|null $description توضیح لینک (اختیاری)
     * @return array نتیجه عملیات
     */
    public function createLinkPost(string $text, string $url, ?string $title = null, ?string $description = null): array
    {
        try {
            $articleData = ['source' => $url];
            if ($title) {
                $articleData['title'] = $title;
            }
            if ($description) {
                $articleData['description'] = $description;
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'LinkedIn-Version' => '202502',
                'X-Restli-Protocol-Version' => '2.0.0',
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->post($this->baseUrl . 'posts', [
                'author' => $this->authorUrn,
                'commentary' => $text,
                'visibility' => 'PUBLIC',
                'distribution' => [
                    'feedDistribution' => 'MAIN_FEED',
                    'targetEntities' => [],
                    'thirdPartyDistributionChannels' => []
                ],
                'content' => [
                    'article' => $articleData
                ],
                'lifecycleState' => 'PUBLISHED',
                'isReshareDisabledByAuthor' => false
            ]);

            if ($response->failed()) {
                throw new RequestException($response);
            }

            $postId = $response->header('X-RestLi-Id');

            return [
                'success' => true,
                'post_id' => $postId,
                'message' => 'پست با لینک با موفقیت در لینکدین منتشر شد',
            ];
        } catch (\Exception $e) {
            Log::error('خطا در ارسال پست با لینک به لینکدین: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'خطا در ارسال پست با لینک به لینکدین',
                'error' => $e->getMessage(),
            ];
        }
    }
}
