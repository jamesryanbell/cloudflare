[![Build Status](https://travis-ci.org/jamesryanbell/cloudflare.svg?branch=master)](https://travis-ci.org/jamesryanbell/cloudflare) [![Coverage Status](https://img.shields.io/coveralls/jamesryanbell/cloudflare.svg)](https://coveralls.io/r/jamesryanbell/cloudflare?branch=master) [![Dependency Status](http://www.versioneye.com/user/projects/53e78e96e09a429c6200000a/badge.svg?style=flat)](http://www.versioneye.com/user/projects/53e78e96e09a429c6200000a) [![Latest Stable Version](https://poser.pugx.org/jamesryanbell/cloudflare/v/stable.svg)](https://packagist.org/packages/jamesryanbell/cloudflare) [![Total Downloads](https://poser.pugx.org/jamesryanbell/cloudflare/downloads.svg)](https://packagist.org/packages/jamesryanbell/cloudflare) [![StyleCI](https://styleci.io/repos/22810771/shield)](https://styleci.io/repos/22810771) [![License](https://poser.pugx.org/jamesryanbell/cloudflare/license.svg)](https://packagist.org/packages/jamesryanbell/cloudflare) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jamesryanbell/cloudflare/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jamesryanbell/cloudflare/?branch=master)

# CloudFlare API - PHP

The documentation for the API can be found at https://api.cloudflare.com, I will try to update this as soon as possible when new features are added to the API. If I miss one please submit a pull request.

If you spot an issue with the package just let me know via issues but please include as much detail as possible, ideally with code examples, environment information etc.

Documentation for this package can be viewed here: https://jamesryanbell.github.io/cloudflare/

## Installation
Installation should be done via composer, details of how to install composer can be found at https://getcomposer.org/

``` bash
$ composer require jamesryanbell/cloudflare
```

## Usage

In situations where you want to make multiple calls to the API across different services it's easier to create a connection to the api first and then pass that around the other services e.g.

```php
    use Cloudflare\Zone\Dns;

    // Create a connection to the Cloudflare API which you can
    // then pass into other services, e.g. DNS, later on
    $client = new Cloudflare\Api('email@example.com', 'API_KEY');

    // Create a new DNS record
    $dns = new Cloudflare\Zone\Dns($client);
    $dns->create('12345678901234567890', 'A', 'name.com', '127.0.0.1', 120);
```

If you are just performing a single action then you can connect to the API directly when you instantiate the class e.g.
```php
    use Cloudflare\Zone\Dns;

    // Create a connection to the Cloudflare API which you can
    // then pass into other services, e.g. DNS, later on
    $dns = new Cloudflare\Zone\Dns('email@example.com', 'API_KEY');
    $dns->create('12345678901234567890', 'TXT', 'name.com', '127.0.0.1', 120);
```

# License
MIT