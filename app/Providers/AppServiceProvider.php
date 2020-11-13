<?php

namespace App\Providers;

use App\Models\Type_Products;
use Illuminate\Support\ServiceProvider;
use App\Cart;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    
    public function boot()
    {
        view()->composer('header', function ($view) {
            $loai_SPs= Type_Products::all();
            $view->with('loai_SPs', $loai_SPs);
        });
        view()->composer('header', function ($view) {
            if (session('cart')) {
                $old_cart = Session('cart');
                $cart = new Cart($old_cart);
                $view->with(['cart' => Session('cart'), 'product_cart' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty' => $cart->totalQty]);
            }
        });
    }
}
