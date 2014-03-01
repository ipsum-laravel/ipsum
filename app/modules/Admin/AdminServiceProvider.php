<?php
namespace Ipsum\Admin;

use Illuminate\Support\ServiceProvider;

/**
 * Description of ActualiteServiceProvider
 *
 * @author a
 */
class AdminServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->package('Ipsum/Admin', 'IpsumAdmin', __DIR__);

        include __DIR__.'/routes.php';
        include __DIR__.'/macros.php';
    }

    public function register()
    {

    }
}
