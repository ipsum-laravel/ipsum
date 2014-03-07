<?php
namespace Ipsum\Website;

use Illuminate\Support\ServiceProvider;

/**
 * Description of WebsiteServiceProvider
 *
 * @author a
 */
class WebsiteServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->package('Ipsum/Website', 'IpsumWebsite', __DIR__);

        include __DIR__.'/routes.php';
    }

    public function register()
    {

    }
}
