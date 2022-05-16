# Task

The challenge is to create a JSON API, which will allow the consumer to search for TV shows by their name, using a simple query string as a GET parameter like so:

```bash
http://localhost:8000/?q=deadwood
```

## Prerequisites/Requirements

- PHP 7.4 or greater

## Installation

Use the [composer](https://getcomposer.org/) to install packages.

```bash
composer install
```

## Configuration

All of the configuration options for the Lumen framework are stored in the **.env** file. Once Lumen is installed, you should also configure your local environment.

## Serving Your Application

To serve your project locally you may use the built-in PHP development server:

```bash
php -S localhost:8000 -t public
```

## Steps for execute

1. Open the terminal and go inside project folder.
2. Run the command `php -S localhost:8000 -t public` to serving your application.
3. **_Hit_**: `http://localhost:8000/?q=deadwood` for getting the results.

## What we are using

1. We are using the **file cache** for optimization the number of HTTP requests to the third party service
2. After getting results we are saving the data in cache with **2 minutes** expiry time.

## Unit Testing & Code Coverage

`This Task` ships with unit tests using [PHPUnit](https://phpunit.de/getting-started-with-phpunit.html/).

- If PHPUnit is installed globally run `phpunit` to run the tests.

- If PHPUnit is not installed globally, install it locally throuh composer by running `composer install --dev`. Run the tests themselves by calling `vendor/bin/phpunit`.

## Notes

**_How you think the API can be evolved in the future, and changes you would like to make, given more time?_**

Few things I can think if top of my head are:

**Filtering Options:**
The api can respond differently based on filters, for instance we can let user decide if he/she wants an exact match or an approximate result

**Analytics:**
I think it would be beneficial to extract useful insights from api usage and can be used to create a business model on top of the api and also we can improve our response to provide better user experience.
- For example, if we know the most queried terms we can cache them even longer on our side to provide results fast or even maintain a cache for such terms with the help of a cron job and make sure user always gets up to dated data

**Throttling:**
Would be nice to implement throttling also so that users cannot just DDOS our api
