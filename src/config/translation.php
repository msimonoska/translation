<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Languages
    |--------------------------------------------------------------------------
    |
    | This value is array of all languages that you will use in your application
    |
    */
    'languages' => explode(',', env('LANGUAGES', 'en')),

    /*
   |--------------------------------------------------------------------------
   | Default Language Source
   |--------------------------------------------------------------------------
   |
   | This option controls the default source/way how
   | the translations will be stored and
   | from where they will be retrieved
   |
   | Supported: "database"
   |
   */
    'source' => env('LANGUAGES_SOURCE', 'database'),

    /*
     * The model that should be used to store translations
     */
    'model' => Msimonoska\Translation\Models\Translation::class,

    /*
     * The middleware that should be used to protect the routes
     */
    'middleware' => ['web'],

    /*
     * The layout that should be used for the views
     * make sure to have jquery, bootstrap and
     * sweetalert2 installed
     */
    'layout' => 'layouts.app',


];
