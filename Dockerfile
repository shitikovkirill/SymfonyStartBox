FROM debian
RUN apt-get update && apt-get install -y apt-transport-https lsb-release ca-certificates wget git unzip

# ADD PHP repository
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list

# Install PHP extantions
RUN apt-get update && apt-get install -y php7.1 php7.1-dev php7.1-gd php7.1-gettext php7.1-intl php7.1-mcrypt php7.1-common php7.1-mysql php7.1-zip php7.1-xml
RUN apt-get install -y curl libcurl3 php7.1-curl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Install Symfony installer
RUN curl -LsS http://symfony.com/installer -o /usr/local/bin/symfony && \
chmod a+x /usr/local/bin/symfony


# Setup the Xdebug version to install
ENV XDEBUG_VERSION 2.5.5
ENV XDEBUG_MD5 81bca42ea6a1f7080f501b00d8122a01

# Install Xdebug
RUN set -x \
	&& curl -SL "http://www.xdebug.org/files/xdebug-$XDEBUG_VERSION.tgz" -o xdebug.tgz \
	&& echo $XDEBUG_MD5 xdebug.tgz | md5sum -c - \
	&& mkdir -p /usr/src/xdebug \
	&& tar -xf xdebug.tgz -C /usr/src/xdebug --strip-components=1 \
	&& rm xdebug.* \
	&& cd /usr/src/xdebug \
	&& phpize \
	&& ./configure \
	&& make -j"$(nproc)" \
	&& make install \
	&& make clean

COPY ext-xdebug.ini /etc/php/7.1/cli/conf.d/

WORKDIR /var/www/symfony

ADD . /var/www/symfony
RUN cd /var/www/symfony && ls  #composer install --no-scripts