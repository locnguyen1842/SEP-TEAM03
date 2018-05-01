<?php

namespace App\Providers;

use App\Cart;
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
        //share view
        view()->composer('header',function($view){
            $loai_sp = productType::all();

            $view->with('loai_sp',$loai_sp);
        });
        view()->composer('header',function($view){
            if(Session('cart'))
            {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'), 'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,
                'totalQty'=>$cart->totalQty]);
            }
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
