FROM ginsen/php-fpm:8.2

ARG USER
ARG USER_NAME
ARG USER_EMAIL
ARG USER_ID

# Install APT sources nodejs & yarn
RUN curl -sL https://deb.nodesource.com/setup_22.x | bash -
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt update && apt install -y nodejs yarn

# Sonar Scanner
RUN npm i -g sonarqube-scanner

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# XDebug
COPY docker/xdebug/php-xdebug.ini /usr/local/etc/php/conf.d/php-xdebug.ini

# Create user
RUN groupadd ${USER}
RUN useradd -g ${USER} -u ${USER_ID} -d /home/${USER} -m -s /bin/bash ${USER}
COPY docker/bash/ssh/id_rsa* /home/${USER}/.ssh/
COPY docker/bash/.gitconfig /home/${USER}/
COPY docker/bash/.bashrc /home/${USER}/.bashrc
COPY docker/bash/.bash_aliases /home/${USER}/.bash_aliases

RUN chown -R ${USER}:${USER} /home/${USER}
RUN sed -i "s/EMAIL/${USER_EMAIL}/g" /home/${USER}/.gitconfig
RUN sed -i "s/NAME/${USER_NAME}/g"  /home/${USER}/.gitconfig
RUN chmod 600 /home/${USER}/.ssh/id_rsa
RUN chmod 600 /home/${USER}/.ssh/id_rsa.pub
RUN /bin/bash -c "eval '$(ssh-agent -s)'; ssh-add /home/${USER}/.ssh/id_rsa"
RUN mkdir /var/www/app
RUN chown -R ${USER}:${USER} /var/www/app

WORKDIR /var/www/app


