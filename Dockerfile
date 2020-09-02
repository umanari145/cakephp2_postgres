FROM amazonlinux:2

# インストール済みのパッケージを最新版にアップデート
RUN yum -y update && \
    # 追加で必要なパッケージをインストール
    yum -y install \
        sudo \
        shadow-utils \
        procps \
        wget \
        openssh-server \
        openssh-clients \
        which \
        iproute \
        vim \
        e2fsprogs && \
    # キャッシュを削除
    yum clean all
 
# install nginx
RUN amazon-linux-extras install nginx1.12 php7.3 -y

WORKDIR /var/www/html

RUN mkdir ./app
RUN mkdir ./lib
RUN mkdir ./db

COPY app/ /var/www/html/app/
COPY lib/ /var/www/html/lib/
COPY db/ /var/www/html/db/

COPY index.php /var/www/html/
COPY phinx.yml /var/www/html/
COPY composer.json /var/www/html/
COPY composer.lock /var/www/html/
COPY wait-for-it.sh /var/www/html/
COPY start.sh /var/www/html/
COPY default.conf /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/nginx.conf
COPY www.conf /etc/php-fpm.d/www.conf
COPY php.ini /etc/php.ini

WORKDIR /var/www/html/app

# Create tmp directory and make it writable by the web server
RUN mkdir -p \
    tmp/cache/models \
    tmp/cache/persistent \
  && chmod -R 770 \
    tmp

WORKDIR /var/www/html

CMD ./wait-for-it.sh ${DB_HOST}:5432 --timeout=30 --strict -- ./start.sh

EXPOSE 80