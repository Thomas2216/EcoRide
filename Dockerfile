FROM php:8.2-apache

# Dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libssl-dev \
    libzip-dev \
    zip \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Extensions PHP pour Symfony + MySQL
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Extension MongoDB via PECL
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Activation du mod_rewrite Apache pour Symfony
RUN a2enmod rewrite

# Configuration Apache : document root sur public/
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN echo '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>' \
    >> /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copie des fichiers projet
COPY . .

# Installation des dépendances Composer
RUN composer install --no-interaction --optimize-autoloader

# Permissions sur var/ (cache, logs)
RUN chown -R www-data:www-data var/

EXPOSE 80
