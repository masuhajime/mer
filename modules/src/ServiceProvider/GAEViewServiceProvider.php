<?php namespace Mer\ServiceProvider;

use Illuminate\View\Engines\CompilerEngine;

class GAEViewServiceProvider extends \Illuminate\View\ViewServiceProvider
{
    /**
     * Register the Blade engine implementation.
     *
     * @param  \Illuminate\View\Engines\EngineResolver  $resolver
     * @return void
     */
    public function registerBladeEngine($resolver)
    {
        $app = $this->app;

        // The Compiler engine requires an instance of the CompilerInterface, which in
        // this case will be the Blade compiler, so we'll first create the compiler
        // instance to pass into the engine so it can compile the views properly.
        $app->bindShared('blade.compiler', function($app)
        {
            $cache = $app['path.storage'].'/views';

            return new \Mer\ServiceProvider\GAEBladeCompiler($app['files'], $cache);
        });

        $resolver->register('blade', function() use ($app)
        {
            return new CompilerEngine($app['blade.compiler'], $app['files']);
        });
    }
}
