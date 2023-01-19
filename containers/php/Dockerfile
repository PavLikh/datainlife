FROM php:7.4-fpm

ARG APP_ENV='prod'
ARG APP_ENV=${APP_ENV}
ENV APP_ENV ${APP_ENV}
 
ARG USER='1000'
ARG USER=${USER_ID}
ENV USER ${USER_ID}
 
ARG GROUP='1000'
ARG GROUP=${GROUP_ID}
ENV GROUP ${GROUP_ID}
 
ARG PROJECT_PREFIX='develop'
ARG PROJECT_PREFIX=${PROJECT_PREFIX}
ENV PROJECT_PREFIX=${PROJECT_PREFIX}

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

RUN apt-get update && apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        ssmtp \
        curl \
        bash \
    && pecl install memcache-4.0.5.2 \
    && docker-php-ext-enable memcache \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache \
    && docker-php-ext-install mysqli \
    && install-php-extensions ldap \
    && install-php-extensions zip \
    && install-php-extensions soap


ADD ./conf/bitrix.ini "/usr/local/etc/php/conf.d/bitrix.ini"
ADD ./conf/www.conf "/usr/local/etc/php-fpm.d/www.conf"

#RUN sed -i -e "s/www-data:x:33:33:www-data:\/var\/www:\/usr\/sbin\/nologin/www-data:x:${USER_ID}:${GROUP_ID}:www-data:\/var\/www\/html:\/bin\/bash/g" /etc/passwd
#RUN sed -i -e "s/www-data:x:33:/www-data:x:${GROUP_ID}:/g" /etc/group
#RUN cd /etc && ls -la
#RUN chmod a+w /etc/ImageMagick-6/policy.xml
#RUN sed -i -e 's/coder" rights="none" pattern="PDF/coder" rights="read|write" pattern="PDF/g' /etc/ImageMagick-6/policy.xml
#RUN rm -f /etc/php/7.4/fpm/pool.d/z-overrides.conf
#RUN cd /bin && curl --silent --show-error https://getcomposer.org/installer | php && mv composer.phar composer && chmod 777 composer
#RUN ln -f -s /usr/bin/php7.4 /etc/alternatives/php
WORKDIR /home/bitrix/www
EXPOSE 9000
