<p align="center">
  <img src="https://static.kickbox.io/kickbox_github.png" alt="Kickbox Email Verification Service">
  <br>
</p>

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


In your config.yml, you must configure:

```yaml
# Default configuration for extension with alias: "andi_kick_box"
andi_kick_box:

    # API key list.
    api_keys:             # Required

        # Prototype
        name:

            # The api key generated in kickbox.io.
            key:                  ~ # Required

    # The default API name.
    default_api_name:     ~

    # The endpoint of the kickbox API.
    endpoint:             'https://api.kickbox.io/v2/verify'
```


