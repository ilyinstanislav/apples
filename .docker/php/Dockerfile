FROM centos:7

ARG USER_ID=1000
ARG USER_NAME=apples-user
ARG COMPOSER_VERSION=1.10.6

#COPY google-chrome.repo /etc/yum.repos.d/google-chrome.repo

# setup repo
RUN yum install -y \
    http://rpms.remirepo.net/enterprise/remi-release-7.rpm

RUN mkdir /var/run/php-fpm

# install software
RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-* && \
    yum -y --enablerepo=remi-php72 install \
    php \
    php-cli \
    php-soap \
    php-curl \
    php-gd \
    php-xml \
    php-xmlrpc \
    php-mbstring \
    php-mysqlnd \
    php-memcached \
    php-process \
    php-fpm \
    php-ldap \
    php-opcache \
    php-intl \
    php-pinba \
    google-chrome-stable \
    php-pecl-xdebug.x86_64 \
    # php-amqplib dependency
    php-bcmath \
    # composer, facebook/webdriver dependency
    php-zip \
    # wkhtmltox
    xorg-x11-fonts-Type1 \
    xorg-x11-fonts-75dpi \
    urw-fonts \
    https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.5/wkhtmltox-0.12.5-1.centos7.x86_64.rpm \
    && \
    yum clean all && rm -rf /var/cache/yum

# composer dependency
RUN yum install -y \
    https://packages.endpoint.com/rhel/7/os/x86_64/endpoint-repo-1.7-1.x86_64.rpm
RUN yum install -y \
    unzip \
    git

# install composer
RUN curl -Lo /tmp/composer.phar https://getcomposer.org/download/$COMPOSER_VERSION/composer.phar && \
    curl -Lo /tmp/composer.phar.sha256sum https://getcomposer.org/download/$COMPOSER_VERSION/composer.phar.sha256sum && \
    cd /tmp && \
    sha256sum --status -c composer.phar.sha256sum && \
    mv /tmp/composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    rm -rf /tmp/*

RUN adduser --password "" -u $USER_ID $USER_NAME
RUN chown $USER_NAME:$USER_NAME /var/log/php-fpm && chown $USER_NAME:$USER_NAME /var/run/php-fpm

WORKDIR /var/www/apples
CMD php-fpm -F -R
