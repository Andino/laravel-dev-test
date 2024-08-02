<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Proyecto SES Event API
Este proyecto implementa una API que procesa datos de eventos SES de Amazon, utilizando **Laravel** y **Spatie/laravel-data** para manejar la validación y transformación de datos. También se utilizan **Resources** de Laravel para formatear la respuesta de la API según los requerimientos específicos.

## Postman Collection
La collection de postman esta adjunta en el repositorio bajo el nombre de **Laravel Test.postman_collection.json**

## Tecnologías Utilizadas

- **Laravel**: Framework PHP para el desarrollo de aplicaciones web.
- **Spatie/Laravel-Data**: Biblioteca para definir y validar datos fuertemente tipados.

## Estructura del Proyecto

### Modelos de Datos y Clases de Datos

- **SES**: Clase de datos que representa un registro de evento SES.
- **SES**: Clase de datos anidada dentro de `SESRecord`, que incluye detalles como `receipt` y `mail`.
- **Receipt**: Clase de datos que contiene información sobre el recibo del correo, como verificaciones de spam y virus.
- **Mail**: Clase de datos que contiene detalles sobre el correo, como el `timestamp` y los `headers`.

### Recursos de Laravel

- **SESRecordResource**: Resource de Laravel para formatear la salida de `SESRecord`, incluyendo métodos para transformar datos específicos como:
  - `mes`: Extrae el mes de `mail.timestamp`.
  - `retrasado`: Indica si `processingTimeMillis` es mayor a 1000.
  - `emisor`: Obtiene el usuario de `mail.source` sin el dominio.
  - `receptor`: Lista de usuarios de `mail.destination` sin los dominios.

## Implementación Detallada

### Creación y Uso de Clases de Datos

Las clases de datos están definidas utilizando **Spatie/Laravel-Data**, que proporciona una forma estructurada de definir datos tipados y validar su estructura. Los datos se inicializan y validan utilizando el método `from()` o `collect()` similar a un API Resource.

#### Ejemplo de Uso
```php
return $dataClass::from($data);
```
o
```php
return $dataClass::collect($data);
```

## Enlaces Útiles y Referencias

### Laravel

- [Documentación General de Laravel](https://laravel.com/docs)
- [Form Requests](https://laravel.com/docs/11.x/validation#form-request-validation)
- [API Resources](https://laravel.com/docs/11.x/eloquent-resources)
- [Service Providers](https://laravel.com/docs/11.x/providers)
- [Container: Dependency Injection](https://laravel.com/docs/11.x/container#dependency-injection)
- [Contracts](https://laravel.com/docs/11.x/contracts)
- [Collections](https://laravel.com/docs/11.x/collections)
- [Request Validation](https://laravel.com/docs/11.x/validation)
- [Middleware](https://laravel.com/docs/11.x/middleware)
- [Single ActionController](https://laravel.com/docs/11.x/controllers#single-action-controllers)

### Spatie Laravel Data

- [Spatie Laravel Data - GitHub](https://github.com/spatie/laravel-data)
- [Documentación de Spatie Laravel Data](https://spatie.be/docs/laravel-data/v1/introduction)
