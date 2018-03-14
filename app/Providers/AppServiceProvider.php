<?php

namespace App\Providers;

use App\Observer\UserObserver;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //Carbon::setLocale('zh');

        \View::composer('*', function (View $view) {
            $view->with("currentUser", \Auth::user());
        });


        // 事件注册
        User::observe(UserObserver::class);



        // blade 扩展
        /**
         *  是否是当前用户的, 参数为其他用户id
         */
        Blade::if('me', function ($id) {
            return \Auth::id() === $id;
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
