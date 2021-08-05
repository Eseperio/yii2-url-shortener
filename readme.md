# Yii2 url shortener.

I´ve created this library since Google closed his one.


## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require erosdelalamo/yii2-url-shortener
```

or add

```
"erosdelalamo/yii2-url-shortener": "^0.1.0"
```

to the require section of your `composer.json` file.


## Setting

**First:** Run the migration included in @vendor/eseperio/yii2-url-shortener/src/migrations.

**Second:** Add this setting to your `config\main.php` file.

Add the bootstrap, module and components class:
```php

'basePath' => dirname(__DIR__),
'bootstrap' => [
     'log',
     'shortener',
],
'modules' => [
     'shortener' => [
            'class' => \eseperio\shortener\ShortenerModule::class
        ]
],
'components' => [
     'shortener' => [
            'class' => 'eseperio\shortener\Bootstrap'
        ],
],
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
