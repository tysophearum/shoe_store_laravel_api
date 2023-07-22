<?php

namespace App\Providers;

use App\Models\Promotion;
use App\Models\Size;
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
        if(Size::all()->count() == 0) {
            for($i=37;$i<=50;$i++){
                $size = new Size(['size' => $i]);
                $size->save();
            }
        }
        if(Promotion::all()->count() == 0) {
            $promotion = new Promotion(['discount' => 30]);
            $promotion->save();
        }
    }
}
