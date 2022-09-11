# Translation Module for Laravel 5.5
[![Latest Stable Version](https://poser.pugx.org/msimonoska/translation/v/stable)](https://packagist.org/packages/msimonoska/translation)
[![Total Downloads](https://poser.pugx.org/msimonoska/translation/downloads)](https://packagist.org/packages/msimonoska/translation)
[![Latest Unstable Version](https://poser.pugx.org/msimonoska/translation/v/unstable)](https://packagist.org/packages/msimonoska/translation)
[![License](https://poser.pugx.org/msimonoska/translation/license)](https://packagist.org/packages/msimonoska/translation)
[![Monthly Downloads](https://poser.pugx.org/msimonoska/translation/d/monthly)](https://packagist.org/packages/msimonoska/translation)
[![Daily Downloads](https://poser.pugx.org/msimonoska/translation/d/daily)](https://packagist.org/packages/msimonoska/translation)

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
This is my first Laravel package, so if you find any bugs or have any suggestions, please let me know. It as fun to make it, so I will be happy to improve it :)

## License
This package is free software distributed under the terms of the [MIT license](https://opensource.org/licenses/MIT). Enjoy!
