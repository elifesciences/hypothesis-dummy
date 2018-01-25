FROM elifesciences/php_cli

USER root
RUN mkdir /srv/hypothesis-dummy && chown elife:elife /srv/hypothesis-dummy

USER elife
WORKDIR /srv/hypothesis-dummy
COPY composer.json composer.lock /srv/hypothesis-dummy/
RUN composer install --classmap-authoritative --no-dev
COPY . /srv/hypothesis-dummy

USER www-data
EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "web/"]
