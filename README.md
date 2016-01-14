# tel.search.ch PHP API Wrapper

A simple PHP API wrapper for http://tel.search.ch. A valid API key is required!

## Installation

Download the latest release or install it with composer (`composer require twomedia\tel-search-php-api`)

### Laravel

Require `TwoMedia\TelSearch\TelSearchProvider::class` in your providers list in `config/app.php`.

```php
    $providers = [
        ...
        TwoMedia\TelSearch\TelSearchServiceProvider::class,
        ...
    ];
```

Add your API key in your services config file with the key `tel-search.secret`:

```
    ...
        'tel-search' => [
            'secret' => 'YOUR_SECRET_API_KEY'
        ],
    ...
``

## Usage

Create a new Instance of the Client and pass your API key to the constructor. Search for Names or Geolocations with the `what()` and `where()` methods.
If you use Laravel, you can get the instance from the IoC Container and

```php
    $client = new TwoMedia\TelSearch\Client("YOUR_API_KEY");
    $response = $client->what(["Max", "Mustermann", "044123456"])->where(["Zürich"])->send();
    $entries = $response->entries();

    // Laravel
    $client = app("TwoMedia\TelSearch\Client");
    $response = $client->what(["Max", "Mustermann", "044123456"])->where(["Zürich"])->send();
    $entries = $response->entries();

```

The package returns 10 results by default. Package specific settings might be introduced in the future.
You can find further documentation to the API [here](http://tel.search.ch/api/help).

## License

This code is published under the [MIT License](http://opensource.org/licenses/MIT).
This means you can do almost anything with it, as long as the copyright notice and the accompanying license file is left intact.