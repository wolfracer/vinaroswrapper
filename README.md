# vinaroswrapper
a simple wrapper to vinaros public-lighting API


# Vinaros API wrapper



### Instalacion
se requiere composer para la instalacion de esta libreria, para mas detalles:
https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos
luego;
simplemente agrega el requerimiento a tu composer.json

```sh
{
    "require": {
       "wolfracer/vinaroswrapper": "^7.0"
    }
}
```

despues de instalar necesitas requerir el auto-loader de composer:

```php
require 'vendor/autoload.php';
```


#### Atencion con certificado SSL.

el api de vinaros utiliza el antiguo protocolo TLS 1.0 que ha sido desactivado por defecto en ubunutu 20.04, lo cual saltara excepcion en la libreria, para evitar esto: https://askubuntu.com/questions/1250787/when-i-try-to-curl-a-website-i-get-ssl-error


#### Incio Rapido.

```php
use Vinaros\VinarosAlumbradoWrapper;
//instanciar con el url y token del api a acceder, en este caso las de alumbrado publico de vinaros.
$url = 'https://46.24.7.148:8091/lighting/API/v1/';
$token = 'dGVzdDpOZDdHZ29DVWV5V1tFamxTQlduTQ==';
$controller = 'CM0001';
$start_date = '2021-01-30T00:00:00%2B01:00';
$end_date = '2021-02-01T00:00:00%2B01:00';

$wrapper = new VinarosAlumbradoWrapper($url, $token);
//devuelve en formato json el listado de todos los controladores en el api
$json_list = $wrapper->list();
//devuelve el estado de un controlador, pasandole el codigo del mismo
$json_detail = $wrapper->retrieve($controller);
//devuelve todos los valores del controlador pasado entre el intervalo de fechas dado
$json_date_range = $wrapper->retrieve_date_range($controller, $start_date, $end_date);
```


