# Training de Drupal 8

Algunos settings

* hay un archivo llamado example.gitignore, quitarle el "example" para que git tome el gitignore.
* el owner la carpeta de sites/default debe ser apache antes de la instalacion
* despues de la instalacion recomiendo que el usuario normal tenga permisos para editar el settings.php
* crear estos 4 archivos
    * settings.local.php
    * settings.dev.php
    * settings.staging.php
    * settings.prod.php
* estos archivos son para soportar settings por envionment
* observacion: por default el gitignore ignora el archivo settings.php, pero en este sitio haremos que lo versione para guardar aqui settings en general
que apliquen para todos los envionments, y para las configuraciones por envionment (base de datos, settings de performance, etc) se haran por environment y eso no se versionanara
* hasta nuevo aviso, drush aun se necesita para muchas cosas como dumnpear o restaurar bases de datos, o generar configurations a otros environments aparte del de sync
