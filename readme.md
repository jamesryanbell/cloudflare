[![Build Status](https://travis-ci.org/jamesryanbell/cloudflare.svg?branch=master)](https://travis-ci.org/jamesryanbell/cloudflare)
[![Coverage Status](https://img.shields.io/coveralls/jamesryanbell/cloudflare.svg)](https://coveralls.io/r/jamesryanbell/cloudflare?branch=master)
[![Dependency Status](http://www.versioneye.com/user/projects/53e78e96e09a429c6200000a/badge.svg?style=flat)](http://www.versioneye.com/user/projects/53e78e96e09a429c6200000a)

[![Latest Stable Version](https://poser.pugx.org/jamesryanbell/cloudflare/v/stable.svg)](https://packagist.org/packages/jamesryanbell/cloudflare) [![Total Downloads](https://poser.pugx.org/jamesryanbell/cloudflare/downloads.svg)](https://packagist.org/packages/jamesryanbell/cloudflare) [![Latest Unstable Version](https://poser.pugx.org/jamesryanbell/cloudflare/v/unstable.svg)](https://packagist.org/packages/jamesryanbell/cloudflare) [![License](https://poser.pugx.org/jamesryanbell/cloudflare/license.svg)](https://packagist.org/packages/jamesryanbell/cloudflare)

#Cloudflare API V4 PHP wrapper

A work in progress library for the Cloudflare API. The documentation for the API can be found at https://www.cloudflare.com/docs/.


I have integrated most of the methods available but many features from the current API have not been implemented yet. For now I suggest you use the API wrapper written by [vexxhost](https://github.com/vexxhost) which can befound at https://github.com/vexxhost/CloudFlare-API.


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
    $dns = new Cloudflare\Dns($client);
    $dns->create('12345678901234567890', 'TXT', '127.0.0.1', 120);
```

If you are just performing a single action then you can connect to the API directly when you instantiate the class e.g.
```php
    use Cloudflare\Zone\Dns;

    // Create a connection to the Cloudflare API which you can
    // then pass into other services, e.g. DNS, later on
    $dns = new Cloudflare\Zone\Dns('email@example.com', 'API_KEY');
    $dns->create('12345678901234567890', 'TXT', '127.0.0.1', 120);
```

#License
MIT