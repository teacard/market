# 使用 PHP + Apache 映像檔
FROM php:7.4-apache

# 啟用 Apache rewrite 模組（如果你有 .htaccess）
COPY apache.conf /etc/apache2/sites-available/000-default.conf
COPY port.conf /etc/apache2/ports.conf
RUN a2enmod rewrite

# 安裝 PHP 擴充與必要套件
RUN apt-get update && apt-get install -y \
    zip unzip libzip-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install \
    mysqli pdo pdo_mysql mbstring zip intl simplexml opcache

# 複製整個專案到 Apache 根目錄
COPY . /var/www/html

# 設定 Apache 權限（可選）
RUN chmod -R 775 /var/www/html
RUN chmod -R 777 /var/www/html/uploads
