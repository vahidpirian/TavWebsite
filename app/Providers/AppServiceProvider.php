<?php

namespace App\Providers;

use App\Models\Content\Comment;
use App\Models\Content\Menu;
use App\Models\Content\Page;
use App\Models\Content\Service;
use App\Models\Content\ServiceMenu;
use App\Models\Setting\Setting;
use App\Models\Setting\SettingFooter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') == 'production') {
            \URL::forceScheme('https');
        }

        view()->composer('admin.layouts.header', function ($view) {
            $view->with('unseenComments', Comment::where('seen', 0)->get());
        });

        view()->composer('site.layouts.master', function ($view) {
            $view->with('menus',Menu::where('status', 1)->whereNull('parent_id')->orderBy('sort_order')->get());
            $view->with('service_menus',ServiceMenu::where('status', 1)->whereNull('parent_id')->orderBy('sort_order')->get());
            $view->with('pages',Page::where('status', 1)->get());
            $view->with('services',Service::where('status', 1)->take(6)->get());
            $view->with('setting', Setting::first());
            $view->with('setting_footer', SettingFooter::first());
        });
    }
}
