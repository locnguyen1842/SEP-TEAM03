<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\productType;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        view()->composer('header',function($view){
            $loaisp = productType::all();
            $view->with('loaisp',$loaisp);
        }); // share view
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
