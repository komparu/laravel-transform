<?php namespace ConnorVG\Transform;

use Illuminate\Support\ServiceProvider;

/**
 * Class TransformServiceProvider
 * @package ConnorVG\Transform
 */
class TransformServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('connorvg/transform');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('transform', function($app)
        {
            return new Transform($app);
        });
    }
}
