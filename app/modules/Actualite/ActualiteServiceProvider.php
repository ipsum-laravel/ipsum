<?php
namespace Ipsum\Actualite;

use Illuminate\Support\ServiceProvider;

/**
 * Description of ActualiteServiceProvider
 *
 * @author a
 */
class ActualiteServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->package('Ipsum/Actualite', 'IpsumActualite', __DIR__);

        include __DIR__.'/routes.php';
    }

    public function register()
    {

    }
}
