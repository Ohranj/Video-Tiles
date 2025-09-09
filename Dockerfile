FROM php:8.4-fpm


ARG user=dev
ARG work_dir=/var/www


WORKDIR ${work_dir}


COPY . ${work_dir}
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer


ENV PATH="$PATH:/home/${user}/.composer/vendor/bin"


RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    git \
    zlib1g-dev \
    libzip-dev \
    unzip \
    vim \
    sqlite3 \
    libpng-dev

RUN curl -sL https://deb.nodesource.com/setup_23.x -o /tmp/nodesource_setup.sh
RUN bash /tmp/nodesource_setup.sh
RUN apt-get install -y nodejs


RUN docker-php-ext-install gd zip pdo pdo_mysql

ADD ./docker-configs/php/custom-php.ini /usr/local/etc/php/php.ini-production
ADD ./docker-configs/php/custom-php.ini /usr/local/etc/php/php.ini




RUN useradd -ms /bin/bash ${user}

USER ${user}