<?php

namespace ConfrariaWeb\Select2\Providers;

use Illuminate\Support\ServiceProvider;
use Collective\Html\FormFacade as Form;

class Select2ServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../Views', 'select2');
        Form::component('select2', 'select2::components.form.select2', ['name', 'values' => [], 'selected' => NULL, 'attributes' => [], 'select2Attr' => []]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    /*
    public function provides()
    {
        return [
            'VendorService'
        ];
    }
    */
}
