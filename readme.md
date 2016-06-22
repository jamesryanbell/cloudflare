[![Build Status](https://travis-ci.org/jamesryanbell/cloudflare.svg?branch=master)](https://travis-ci.org/jamesryanbell/cloudflare)
[![Coverage Status](https://img.shields.io/coveralls/jamesryanbell/cloudflare.svg)](https://coveralls.io/r/jamesryanbell/cloudflare?branch=master)
[![Dependency Status](http://www.versioneye.com/user/projects/53e78e96e09a429c6200000a/badge.svg?style=flat)](http://www.versioneye.com/user/projects/53e78e96e09a429c6200000a)

[![Latest Stable Version](https://poser.pugx.org/jamesryanbell/cloudflare/v/stable.svg)](https://packagist.org/packages/jamesryanbell/cloudflare) [![Total Downloads](https://poser.pugx.org/jamesryanbell/cloudflare/downloads.svg)](https://packagist.org/packages/jamesryanbell/cloudflare) [![Latest Unstable Version](https://poser.pugx.org/jamesryanbell/cloudflare/v/unstable.svg)](https://packagist.org/packages/jamesryanbell/cloudflare) [![License](https://poser.pugx.org/jamesryanbell/cloudflare/license.svg)](https://packagist.org/packages/jamesryanbell/cloudflare)

[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/jamesryanbell/cloudflare/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

#Cloudflare API V4 PHP wrapper

A work in progress library for the Cloudflare API. The documentation for the API can be found at https://api.cloudflare.com.

I have implemented all of the methods from the available documentation but if there are more just let me know via issues please https://github.com/jamesryanbell/cloudflare/issues


##Installation
Installation should be done via composer, details of how to install composer can be found at https://getcomposer.org/


Add `"jamesryanbell/cloudflare": "dev-master"` to your `composer.json` file

Run `composer update` to install the latest version.

##Usage

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

#License
MIT
