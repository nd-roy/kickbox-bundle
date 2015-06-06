<p align="center">
  <img src="https://static.kickbox.io/kickbox_github.png" alt="Kickbox Email Verification Service">
  <br>
</p>

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/404da883-9217-4c9f-8e5d-3f4c10c50255/big.png)](https://insight.sensiolabs.com/projects/404da883-9217-4c9f-8e5d-3f4c10c50255)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/AbdoulNdiaye/kickbox-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/AbdoulNdiaye/kickbox-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/AbdoulNdiaye/kickbox-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/AbdoulNdiaye/kickbox-bundle/?branch=master)
[![Build Status](https://travis-ci.org/AbdoulNdiaye/kickbox-bundle.svg?branch=master)](https://travis-ci.org/AbdoulNdiaye/kickbox-bundle)

[![Latest Stable Version](https://poser.pugx.org/andi/kickbox-bundle/v/stable)](https://packagist.org/packages/andi/kickbox-bundle) 
[![Latest Unstable Version](https://poser.pugx.org/andi/kickbox-bundle/v/unstable)](https://packagist.org/packages/andi/kickbox-bundle) 
[![License](https://poser.pugx.org/andi/kickbox-bundle/license)](https://packagist.org/packages/andi/kickbox-bundle)


[![Join the chat at https://gitter.im/AbdoulNdiaye/kickbox-bundle](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/AbdoulNdiaye/kickbox-bundle?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

# Email Verification Library for Symfony

Kickbox determines if an email address is not only valid, but associated with a actual user. Uses include:

* Preventing users from creating accounts on your applications using fake, misspelled, or throw-away email addresses.
* Reducing bounces by removing old, invalid, and low quality email addresses from your mailing lists.
* Saving money and projecting your reputation by only sending to real email users.

## Getting Started

To begin, hop over to [kickbox.io](http://kickbox.io) and create a free account. Once you've signed up and logged in, click on **API Settings** and then click **Add API Key**. Take note of the generated API Key - you'll need it to setup the client as explained below.

## Installation

Make sure you have [composer](https://getcomposer.org) installed.

Add the following to your composer.json

```json
{
    "require": {
        "andi/kickbox": "*"
    }
}
```

Update your dependencies

```bash
$ php composer.phar update
```

> This package follows the `PSR-4` convention names for its classes, which means you can easily integrate these classes loading in your own autoloader.


Register the bundle in app/AppKernel.php

```php
public function registerBundles()
{
    $bundles = array(
        new Andi\KickBoxBundle\AndiKickBoxBundle(),
    );
}
```

In your config.yml, you must configure:

```yaml
# Default configuration for extension with alias: "andi_kick_box"
andi_kick_box:

    # API key list.
    api_keys:             # Required
        toto:
            # The api key generated in kickbox.io.
            key: YOU_API_KEY       # Required
        tata:
            key: AN_OTHER_API_KEY
    # The default API name. If not set, the default value will be the first api name. 
    default_api_name: tata

    # The endpoint of the kickbox API.
    endpoint:             'https://api.kickbox.io/v2/verify'
```

## Usage

Add the following code to our controller:

```php
public function indexAction($email)
{
    $kickboxClient = $this->get('kickbox_client');
    $response      = $kickboxClient->verify($email);
}
```

We can also get a service name with a specific key defined in config.yml

Example: 

```php
	$kickboxClient = $this->get('kickbox_client');  // The default client. In our example : tata
	$kickboxClient = $this->get('kickbox_client.tata');
    $kickboxClient = $this->get('kickbox_client.toto');
```

To simply verify an email :

```php
	$response = $kickboxClient->verify($email);
```

With a timeout :

```php
   // Maximum time, in milliseconds, for the API to complete a verification request. Default value : 6000
   $response = $kickboxClient->verify($email, 6000);
```


> An exception can be thrown by the api client if the HTTP status code is not 200 : Andi\KickBoxBundle\Exception\KickBoxApiException

## Response 

A successful API call responds with the following object:

```php
    $response->getBalance();      // The remaining credit balance (Daily + On Demand).
    $response->getDomain();       // The domain of the provided email address.
    $response->getEmail();        // Returns a normalized version of the provided email address.
    $response->getReason();       // The reason for the result.
    $response->getResponseTime(); // The elapsed time (in milliseconds) it took Kickbox to process the request.
    $response->getResult();       // The verification result: deliverable, undeliverable, risky, unknown
    $response->getSuggestion();   // Returns a suggested email if a possible spelling error was detected.
    $response->getSendex();       // A quality score of the provided email address ranging between 0 (no quality) and 1 (perfect quality).
    $response->getUser();         // The user (a.k.a local part) of the provided email address. (bob@example.com -> bob).

    $response->isAcceptAll();     // If the email was accepted, but the domain appears to accept all emails addressed to that domain.
    $response->isDisposable();    // If the email address uses a disposable domain like trashmail.com or mailinator.com.
    $response->isFree();          // If the email address uses a free email service like gmail.com or yahoo.com.
    $response->isRole();          // If the email address is a role address
    $response->isSuccess();       // If the API request was successful.
```


All the Kickbox API is explained here : [Using api API](http://docs.kickbox.io/v2.0/docs/using-the-api)
