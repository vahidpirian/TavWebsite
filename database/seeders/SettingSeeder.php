<?php

namespace Database\Seeders;

use App\Models\Setting\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = Setting::count();

        if ($setting == 0) {
            DB::table('settings')->insert([
                'title' => 'شرکت بازرگانی تاو 360',
                'description' => 'ثبت سفارش در سامانه جامع تجارت، ترخیص کالا از تمامی گمرکات کشور، سورسینگ کالا از چین، واردات کالا از سرتاسر دنیا',
                'keywords' => 'حمل و ترخیص | سورسینگ | ثبت سفارش | واردات',
                'main_page_subtitle' => 'معتبرترین گروه بازرگانی در حوزه واردات و صادرات',
                'main_page_title' => 'گروه بازرگانی تاو 360',
                'main_page_service_summary' => 'ارائه خدمات تخصصی سورسینگ، خرید خارجی، ثبت سفارش، واردات، حمل و نقل بین‌المللی و ترخیص کالا در تمامی گمرکات کشور',
                'logo' => 'logo.png',
                'icon' => 'logo.png'
            ]);
        }


    }
}
