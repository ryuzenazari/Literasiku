<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;
use App\Helpers\UrlHelper;

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
        // Add custom Blade directive for secure assets
        Blade::directive('secureAsset', function ($expression) {
            return "<?php echo asset($expression, true); ?>";
        });

        // Add custom Blade directive for dynamic assets
        Blade::directive('dynamicAsset', function ($expression) {
            return "<?php echo App\Helpers\UrlHelper::asset($expression); ?>";
        });

        // Add custom Blade directive for dynamic secure assets
        Blade::directive('dynamicSecureAsset', function ($expression) {
            return "<?php echo App\Helpers\UrlHelper::secureAsset($expression); ?>";
        });

        // Add custom Blade directive for current URL
        Blade::directive('currentUrl', function () {
            return "<?php echo App\Helpers\UrlHelper::getAppUrl(); ?>";
        });

        // Add custom Blade directive for environment check
        Blade::directive('ifLocalhost', function ($expression) {
            return "<?php if(App\Helpers\UrlHelper::isLocalhost()): ?>";
        });

        Blade::directive('endifLocalhost', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('ifNgrok', function ($expression) {
            return "<?php if(App\Helpers\UrlHelper::isNgrok()): ?>";
        });

        Blade::directive('endifNgrok', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('ifProduction', function ($expression) {
            return "<?php if(App\Helpers\UrlHelper::getEnvironment() === 'production'): ?>";
        });

        Blade::directive('endifProduction', function () {
            return "<?php endif; ?>";
        });
    }
}
