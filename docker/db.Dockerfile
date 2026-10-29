FROM mariadb:10.11

# El importador corre como mysql: no depender de los permisos del checkout.
COPY --chmod=0444 proyectodm/dmproducciones.sql /docker-entrypoint-initdb.d/01-proyecto.sql
