<?php

namespace Msimonoska\Translation\Providers;
use Illuminate\Support\ServiceProvider;
use Msimonoska\Translation\Console\ExportTranslations;
use Msimonoska\Translation\Console\ImportTranslations;
use Msimonoska\Translation\Console\InstallTranslationPackage;

class TranslationServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallTranslationPackage::class,
                ImportTranslations::class,
                ExportTranslations::class
            ]);
        }

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'translation');


        $this->publishes([
            // config
            __DIR__.'/../config/translation.php' => config_path('translation.php'),
            // views
            __DIR__.'/../resources/views' => resource_path('views/vendor/translation'),
            // migrations
            __DIR__.'/../database/migrations/create_translations_migration.php.stub' => database_path('migrations/' . date('Y_m_d_His', time
                ()) . '_create_translations_table.php'),
        ]);


    }
}
