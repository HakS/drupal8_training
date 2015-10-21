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
* para desinstalar un modulo hay que borrar todos los elementos creados con el mismo, ejemplo si se quiere deshabilitar comment se debe borrar primero los comentarios, luego los campos de tipo comment declarados en diversas entidades, luego borrar los comment types y ahi recien estara disponible la opcion para desinstalar. Tiene que ser en ese ese orden, ya que ahora en D8 todo elemento que dependa de otro estara bloqueado de ser borrado hasta que su dependencia (sea otra configuracion o contenido) se borren tambien... por suerte Drupal Console nos avisa cuales son las dependencias a borrar para poder desinstalar un modulo... por ahora Drupal tiene muy tedioso desinstalalr un modulo, hay un resumen de toda la discusion llevada a cabo en esta pagina https://www.drupal.org/node/2225029, lo que pareciera ser es que por ahora si un modulo contrib pone el sitio muy inestable, si el modulo creo configuraciones y no hay forma de borrarlas en el UI, tocara borrarlas a mano del configuration