FROM php:7.2.8-apache

# Set Non interactive environment
ENV DEBCONF_FRONTEND non-interactive

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Sendmail by mailutils
RUN apt-get update && apt-get install -q -y ssmtp mailutils libpng-dev libfreetype6-dev libjpeg62-turbo-dev && rm -rf /var/lib/apt/lists/*

# FOR USE GMAIL SMTP
# -------------------------------
# RUN docker-php-ext-install pdo_mysql
# RUN docker-php-ext-install -j$(nproc) iconv
# RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
# RUN docker-php-ext-install -j$(nproc) gd
# RUN echo "root=project.camagru.42@gmail.com" >> /etc/ssmtp/ssmtp.conf
# RUN echo "mailhub=smtp.gmail.com:587" >> /etc/ssmtp/ssmtp.conf
# RUN echo "AuthUser=project.camagru.42@gmail.com" >> /etc/ssmtp/ssmtp.conf
# RUN echo "AuthPass=Camagru42" >> /etc/ssmtp/ssmtp.conf
# RUN echo "UseTLS=YES" >> /etc/ssmtp/ssmtp.conf
# RUN echo "UseSTARTTLS=YES" >> /etc/ssmtp/ssmtp.conf
# RUN echo "FromLineOverride=YES" >> /etc/ssmtp/ssmtp.conf
# RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini
# -------------------------------



# FOR USE MAILHOG
# -------------------------------
RUN apt-get update &&\
    apt-get install --no-install-recommends --assume-yes --quiet ca-certificates curl git &&\
    rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install -j$(nproc) iconv
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd
RUN curl -Lsf 'https://storage.googleapis.com/golang/go1.8.3.linux-amd64.tar.gz' | tar -C '/usr/local' -xvzf -
ENV PATH /usr/local/go/bin:$PATH
RUN go get github.com/mailhog/mhsendmail
RUN cp /root/go/bin/mhsendmail /usr/bin/mhsendmail
RUN echo 'sendmail_path = /usr/bin/mhsendmail --smtp-addr mailhog:1025' > /usr/local/etc/php/php.ini
# -------------------------------


#fix unknow ServerName warning
RUN echo "ServerName 172.0.0.3:80" >> /etc/apache2/apache2.conf

# ENABLE HTTPS WITH SELF-SIGNED SSL certificate
# -------------------------------
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj "/C=FR/ST=IDF/O=42/OU=Project-Camagru/CN=192.168.99.100" -keyout /etc/ssl/private/apache-selfsigned.key -out /etc/ssl/certs/apache-selfsigned.crt

COPY ./ssl/ssl-params.conf /etc/apache2/conf-available/ssl-params.conf
COPY ./ssl/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf
COPY ./ssl/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod ssl
RUN a2enmod headers
RUN a2ensite default-ssl
RUN a2enconf ssl-params
RUN apache2ctl configtest

# Workaround for write permission on write to MacOS X volumes
# See https://github.com/boot2docker/boot2docker/pull/534
RUN usermod -u 1000 www-data

# Disable cache for PHP
RUN ( \
  echo "opcache.memory_consumption=128"; \
  echo "opcache.interned_strings_buffer=8"; \
  echo "opcache.max_accelerated_files=20000"; \
  echo "opcache.revalidate_freq=5"; \
  echo "opcache.fast_shutdown=1"; \
  echo "opcache.enable_cli=1"; \
  ) > /usr/local/etc/php/conf.d/opcache-recommended.ini
