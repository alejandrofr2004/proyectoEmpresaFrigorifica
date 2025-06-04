#!/bin/bash

# Establece permisos necesarios para Laravel
chmod -R 777 storage bootstrap/cache
chown -R www-data:www-data /var/www/html

# Instala nano y modifica la configuración de Apache
apt-get update
apt-get install nano -y

# Escribe configuración de Apache directamente
cat > /etc/apache2/sites-available/000-default.conf <<EOF
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html/public

    <Directory /var/www/html>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

# Reinicia Apache
service apache2 restart

# Ejecutar el comando por defecto del contenedor
exec "$@"


