FROM php:8.3-cli

# Install system dependencies needed by various extensions
# RUN apt-get update && apt-get install -y \
#     libpng-dev \
#     libjpeg-dev \
#     libfreetype6-dev \
#     libzip-dev \
#     libxml2-dev \
#     libcurl4-openssl-dev \
#     libonig-dev \
#     libxslt-dev \
#     libgmp-dev \
#     libsodium-dev \
#     libwebp-dev \
#     unzip \
#     git \
#     && rm -rf /var/lib/apt/lists/*

# # Configure extensions that need it
# RUN docker-php-ext-configure gd \
#     --with-freetype \
#     --with-jpeg \
#     --with-webp

# # Install all common PHP extensions
# RUN docker-php-ext-install \
#     mysqli \
#     pdo \
#     pdo_mysql \
#     gd \
#     zip \
#     mbstring \
#     xml \
#     curl \
#     bcmath \
#     intl \
#     xsl \
#     gmp \
#     soap \
#     sockets \
#     pcntl \
#     opcache \
#     exif \
#     gettext \
#     sodium

# # Install PECL extensions (not in core)
# RUN pecl install redis imagick \
#     && docker-php-ext-enable redis imagick

# Set working directory
WORKDIR /app

COPY . .

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "index.php"]