FROM elifesciences/php_cli:22434ef5bda09326d4c9347de7d8c2f1610a0b83

USER elife
ENV PROJECT_FOLDER=/srv/hypothesis-dummy
RUN mkdir ${PROJECT_FOLDER}
WORKDIR ${PROJECT_FOLDER}
COPY --chown=elife:elife composer.json composer.lock ${PROJECT_FOLDER}/
RUN composer-install
COPY --chown=elife:elife src/ ${PROJECT_FOLDER}/src
COPY --chown=elife:elife web/ ${PROJECT_FOLDER}/web
RUN composer-post

USER www-data
EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "web/"]
