# Template
PHP Template Engine

It's a Template Engine developed with Twig as base.

## Requeriments

- PHP Version 7.1 or higher
- Composer

## Installation

```bash
$ composer require makframework/template "^1.0"
```

## Usage

Create a index.php file with the following code:

```php
<?php 
require 'vendor/autoload.php';

$tpl = new Template('./templates/');
$tpl->registerLanguages(['es' => './languages/es.ini']);

$tpl->setData('user_id', 10);

echo $tpl->render('home.html', ['title' => 'home', 'products' => ['PC','Mobile']]);

```

If you also want to translate any words, create a ".ini" file with the following code:

```ini
Some to translate = Algo para traducir
```

Create  a ".html" file with the following code:

```html
<html>
    <head>
        <title>{{title}}</title>
    </head>
    <body>
        <p>User ID: {{user_id}}</p>
        <ul>
         {% for product in products %}
            <li>{{producto}}</li>
         {% endfor %}
        </ul>
        
        <!-- translation -->
        <p>{{'Some to translate'|translate}}</p>
    </body>
</html>
```

The output:

```html
<html>
    <head>
        <title>home</title>
    </head>
    <body>
        <p>User ID: 10</p>
        <ul>
            <li>PC</li>
            <li>Mobile</li>
        </ul>
        
        <!-- translation -->
        <p>Algo para traducir</p>
    </body>
</html>
```

## License

Makframework\Template is licensed under the [MIT license](LICENSE.md).

The project include others third-party libraries that can contain its own licenses:
- [Twig](https://github.com/twigphp/Twig)