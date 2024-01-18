<?php

namespace HeroSeguros\HeroLaravelLibrary;

use HeroSeguros\HeroLaravelLibrary\Commands\MakeRepositoryCommand;
use HeroSeguros\HeroLaravelLibrary\Commands\MakeServiceCommand;
use Illuminate\Support\ServiceProvider;

class HeroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeServiceCommand::class,
                MakeRepositoryCommand::class,
            ]);
        }
    }
}
