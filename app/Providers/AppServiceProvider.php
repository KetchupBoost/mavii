<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Date\Date;

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
        Schema::defaultStringLength(191);

        Date::setLocale('pt');
        
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        Blade::directive('currency', function ($expression) {
            return "<?php echo 'R$ '.number_format($expression, 2); ?>";
        });
    }
}
