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

## Vitacora

* hasta nuevo aviso, drush aun se necesita para muchas cosas como dumnpear o restaurar bases de datos, o generar configurations a otros environments aparte del de sync
* NO SE PUEDEN DESHABILTIAR MODULOS! https://www.drupal.org/node/1199946
* Esto es lo que pasa si tratas de borrar un field de comments (un campo que te trae comentarios): http://screencloud.net/v/xVox
* hasta nuevo aviso, creo que para desinstalar algo que provee cosas va a tocar matar cada elemento creado (ejm: si creas comentarios y nodos con comentarios, tendras que borrar su definicion, como no existen mas hooks para extender codigo (pareciera que los hooks aun existen es para informar, ejm hook_theme) deshabiltar modulos se ha hecho poco factible
* los comentarios son entidades pero tambien son fieldables (si el concepto de una entidad fieldable ya esta imerso en el core, creo que un modulo como fieldcollection ya no deberia ser tan dificil de que exista como en d7)
* nuevo aviso: para desinstalar un modulo al parecer remover un campo de cierto tipo de una entidad no quita sus registros, solo que como no tiene referencia ya no pueden visualizarse.. veo algunas desventajas con ello
    * borrar configuraciones no borrara contenido: es decir que si tengo contenido viejo, esto no se borrara y la bd se llenaria de data inservible?
    * esto hace muy dificil deshacerse de un modulo: si instale un modulo contrib que me define un field type, cree un nuevo field de ese field type y note que el modulo estaba muy buggy y ya no lo quiero, tendria que borrar toda referencia sobre ese modulo para poder desinstalarlo, no me parece muy factible
