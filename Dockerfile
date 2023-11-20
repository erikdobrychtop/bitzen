# Use a imagem oficial do PHP 8.1 com FPM (FastCGI Process Manager)
FROM php:8.1-fpm

# Atualizar pacotes e instalar dependências
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    #php-pgsql \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    libcurl4-openssl-dev \
    libzip-dev \
    libicu-dev \
    g++ \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensões do PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl pdo_pgsql pgsql

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configurar o diretório de trabalho para /var/www (diretório padrão do Laravel)
WORKDIR /var/www

# Dê permissão ao usuário www-data para o diretório /var/www
RUN chown -R www-data:www-data /var/www

# Expor a porta 9000 para que possamos usar com o Nginx ou outro servidor web
EXPOSE 9000

# Iniciar o PHP-FPM
CMD ["php-fpm"]