# DM Producciones: proyecto original con Docker

Este repositorio conserva el proyecto de prácticas de 2025 en `proyectodm/`,
como referencia para el laboratorio de este año. La configuración de Docker
añade el entorno necesario para ejecutarlo sin modificar su PHP, HTML, CSS,
imágenes, videos ni SQL originales.

## Ejecutar en tu PC

Necesitas Docker Engine con Compose v2, o Docker Desktop iniciado con integración
WSL si utilizas Windows. Ejecuta desde la raíz de este repositorio:

```bash
docker compose up -d --build --wait
```

Abre tu navegador en el puerto local **8080** (ruta `/index.php`). La galería
está en `/portafolio.php` y el formulario de ingreso en `/secion.html`.
El usuario de demostración es el que ya define `proyectodm/dmproducciones.sql`.

Para usar otro puerto:

```bash
DM_PORT=8081 docker compose up -d --build --wait
```

Para consultar el estado y los registros:

```bash
docker compose ps
docker compose logs --tail=80 web db
```

Para detener los contenedores conservando la base de datos y las subidas:

```bash
docker compose down
```

Para volver a iniciarlos:

```bash
docker compose up -d --wait
```

## Qué prepara Docker

- PHP 8.2 con Apache, `mysqli` y GD con JPEG, PNG y WebP.
- MariaDB 10.11 con la base `proyectodm2` que espera `conexion.php`.
- Importación del SQL original al crear por primera vez el volumen de datos.
- Un socket Unix compartido para mantener la conexión original a `localhost`.
- Volúmenes para la base de datos y `uploads/`. Las imágenes originales de
  `uploads/` se copian al volumen cuando se crea por primera vez.
- Límites PHP para las imágenes y un directorio temporal Linux.

El SQL original crea las tablas y un usuario, pero **no contiene registros de
portafolios**: la galería dinámica empieza vacía aunque existan fotos en
`uploads/`. Las galerías estáticas, fotos y video del sitio se conservan.

Los cambios al código se incorporan reconstruyendo la imagen con el primer
comando. Los volúmenes existentes conservan sus datos; reconstruir la imagen
no vuelve a importar el SQL ni reemplaza las subidas existentes. Guarda una
copia de tus datos antes de eliminar volúmenes. `docker compose down -v`
elimina la base y las subidas guardadas en Docker.

Esta configuración reproduce XAMPP para una demostración local: conserva la
conexión original de root sin contraseña mediante el socket. Solo publica la
web en la interfaz local del equipo y no publica el puerto de MariaDB.

## Entorno en la nube

El checkout de la tarea ya está aislado; utiliza el existente en
`/workspace/PP1-DmProducciones`, sin crear otro worktree.

La compilación en Codex necesita su CA de proxy. Desde la raíz del repositorio:

```bash
docker compose -f compose.yaml -f docker/compose.cloud.yaml build
docker compose up -d --wait
```

La CA se monta como secreto de compilación y no se incorpora a la imagen.
Los procesos deben iniciarse de nuevo después de restaurar el entorno.
La comprobación de salud de la web solicita `index.php`, que consulta la base;
el estado `healthy` comprueba la respuesta de la aplicación.

## Validación realizada

Se construyeron ambas imágenes y se importó el SQL desde una base nueva.
Pasaron 14 comprobaciones funcionales: página principal, galería vacía inicial,
formulario de ingreso, restricción de acceso a subidas, CSS y logo originales,
lectura parcial del video, login, formulario autenticado, publicación de un
portafolio con PNG procesado por GD, visualización de la imagen y logout.
También se comprobó que el registro y la imagen persistieran después de
eliminar y recrear los contenedores conservando sus volúmenes. Después se
retiraron exclusivamente ese registro y esa imagen de prueba.
