FROM php:8.2-apache

# 1. Install system dependencies + PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev libicu-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring bcmath gd zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Enable Apache rewrite
RUN a2enmod rewrite

# 3. Set working directory
WORKDIR /var/www/html

# 4. Copy project files
COPY . /var/www/html

# 5. Set Apache to use Laravel public folder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

# 6. Fix Apache Directory permissions
RUN echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

# 7. Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 8. Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# 9. Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 10. PHP Settings
RUN echo "memory_limit=256M" > /usr/local/etc/php/conf.d/memory-limit.ini

EXPOSE 80

# 11. Start Script (Clears cache then starts Apache)
CMD sh -c "php artisan config:cache && php artisan route:cache && php artisan view:cache && apache2-foreground"