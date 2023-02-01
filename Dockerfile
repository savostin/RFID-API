FROM php
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    sqlite3
EXPOSE 8000
RUN docker-php-ext-install pdo
RUN docker-php-ext-enable pdo
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY src/ /app/
COPY schema.sql /tmp/
RUN sqlite3 /app/database.db < /tmp/schema.sql && rm /tmp/schema.sql
COPY test_data.sql /tmp/
RUN sqlite3 /app/database.db < /tmp/test_data.sql && rm /tmp/test_data.sql
WORKDIR /app/
RUN composer install
CMD [ "php", "-S", "0.0.0.0:8000" ]
