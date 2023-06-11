# Yii2 url shortener.

    Do not get fooled by the age of changes made to library. It works like the first day, and that is why it has not been updated

Make short links within your own yii2 application. Can even define an expiration date for a shortened url. See this readme file to learn how.

## Installation

Add the module to your config file:

**First:** Run the migration included in @vendor/eseperio/yii2-url-shortener/src/migrations.

```php
  //...

'modules' => [
     'shortener' => [
            'class' => \eseperio\shortener\ShortenerModule::class
        ]
  ]

  //...

```

Add the bootstrap class to your bootstrap configuration.
```php

'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        \eseperio\shortener\Bootstrap::class,
    ],

    'aliases' => [
    //...
```

## Usage


Making a short link

```php
Yii::$app->getModule('shortener')->short('http://original.url/goes/here')

// An array can be provided too.

Yii::$app->getModule('shortener')->short(['controller/action','param' => 'value'])
```

A lifetime can be established. Link will stop working since that date.

```php
Yii::$app->getModule('shortener')->short($url, 3600)
```

Expanding a link

```php
Yii::$app->getModule('shortener')->expand('link id')
```

## Redirection
Module includes a controller to handle redirections. The only thing you need, to make it work, it is create a link to your app domain, followed by the short id of url.

`http://myapp.tld/gGyU`
