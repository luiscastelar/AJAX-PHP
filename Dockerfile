# Use an official PHP runtime
FROM php:8.3-apache

# Actualizamos los paquetes e instalamos las extensiones necesarias de PHP
RUN apt-get update && docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache modules
RUN a2enmod headers rewrite

# Configuramos el nombre del servidor en Apache para evitar advertencias al iniciar el servicio
RUN echo "ServerName yagolivas.com" >> /etc/apache2/apache2.conf
# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Exponemos el puerto 80 para permitir el acceso HTTP al servidor
EXPOSE 80

# Copy the source code in /www into the container at /var/www/html
#COPY ./public .

# Fuente (mixta)
# https://www.guiskas.com/2024/09/04/como-publicar-una-pagina-web-con-apache-php-y-url-amigables-usando-docker/
