# DidUngar\SwaggerUiBundle

Expose swagger-ui inside your symfony project through a route (eg. /docs), just like [nelmio api docs](https://github.com/nelmio/NelmioApiDocBundle), without the need for node.

Just add a reference to your swagger.JSON specification, and enjoy swagger-ui in all it's glory.

After installation and configuration, just start your local webserver, and navigate to [/docs](http://127.0.0.1:8000/docs) or asked path.

## Installation

Install with composer in dev environment (recommended if you don't have private area):

`$ composer require DidUngar/SwaggerUiBundle --dev`

Enable bundle in `app/AppKernel.php` : SF < 4
```php
<?php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        // ...

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            // ...
            $bundles[] = new DidUngar\SwaggerUiBundle\DidUngarSwaggerUiBundle();
        }

        // ...
    }
}
```
Add the bundle to config/bundles.php : SF >= 4
```php
DidUngar\SwaggerUiBundle\DidUngarSwaggerUiBundle::class => ['all' => true],
```

Add the route where swagger-ui will be available in `routing_dev.yml`:

```yaml
didungar_swaggerui:
    resource: "@DidUngarSwaggerUiBundle/Controller/"
    type:     annotation
    prefix:   /docs
```

## Configuration

In your `config_dev.yml`, adding parameter.

Under `files` you specify which swagger.json should be exposed.

```yaml
parameters:
    didungar_swaggerui.swagger_json: "/swagger.json"
```
Pour avoir les routes de bases ajouter dans config/routes.yml (sf >= 4) :
```yaml
app_annotations:
  resource: '../vendor/DidUngar/SwaggerUiBundle/Controller/'
  type:     annotation
```

Ajouter dans config packages twig
```yaml
twig:
    paths:
        - '%kernel.project_dir%/templates'
        - '%kernel.project_dir%/vendor/DidUngar/SwaggerUiBundle/Resources/views'
```

Pour avoir le menu par default :
```
{% include 'Default/menu.html.twig' %}
```
