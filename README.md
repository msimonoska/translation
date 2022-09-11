# Translation Module for Laravel

#### Table of contents
- [Installation](#installation)
    - [Composer](#composer)
    - [Service provider](#service-provider)
    - [Configuration](#configuration)
- [Usage](#usage)
- [Library Note](#library-note)
- [License](#license)

## Installation

### Composer
Install the package with composer require command:
```sh
composer require msimonoska/translation
```
### Service provider
 If you are using Laravel version < 5.5, add the new provider to the `providers` array in `config/app.php` :
```php
'providers' => [
    // ...
    /**
     * Third Party Service Providers...
     */
    Msimonoska\Translation\TranslationServiceProvider::class,
    // ...
],
```

### Configuration
You can publish the configuration file, migrations and views with the following command:
```sh
php artisan translation:install
```

After that, inside your .env file you can set the following variable to specify the languages 
that your platform will work with:
```sh
LANGUAGES=de,en,fr
```

Next you need to run the migrations:
```sh
php artisan migrate
```

Inside the configuration file you can set the middleware that will be used for the routes.


## Usage
Once you install the package, you can use the following routes:

- `GET /translations` - list all translations
- `GET /translations/create` - create a new translation
- `POST /translations` - store a new translation
- `GET /translations/{id}/edit` - edit a translation
- `PUT /translations/{id}` - update a translation
- `DELETE /translations/{id}` - delete a translation

## Library Note:
This is my first Laravel package, so if you find any bugs or have any suggestions, please let me know. It was fun to make it, so I will be happy to improve it :)

## License
This package is free software distributed under the terms of the [MIT license](https://opensource.org/licenses/MIT). Enjoy!
