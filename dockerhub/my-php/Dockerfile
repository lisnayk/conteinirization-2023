FROM ubuntu:22.04

ENV TZ=Europe/Minsk
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update --allow-releaseinfo-change
RUN apt-get install -y nginx
RUN apt-get install -y php8.1-fpm

COPY nginx/default.conf /etc/nginx/conf.d/default.conf

RUN rm /etc/nginx/sites-enabled/default &&  rm  /etc/nginx/sites-available/default

COPY ./src/public /var/www/html

COPY entrypoint.sh /etc/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/etc/entrypoint.sh"]

