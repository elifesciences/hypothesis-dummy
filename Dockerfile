FROM elifesciences/php_cli

USER elife
RUN mkdir /srv/hypothesis-dummy
WORKDIR /srv/hypothesis-dummy
COPY --chown=elife:elife composer.json composer.lock /srv/hypothesis-dummy/
RUN composer install --classmap-authoritative --no-dev
COPY --chown=elife:elife . /srv/hypothesis-dummy/

USER www-data
EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "web/"]
