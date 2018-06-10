FROM mysql:8.0

COPY docker/mysql/conf.d /etc/mysql/conf.d

RUN groupadd -r mysql && useradd -r -g mysql mysql

COPY docker/mysql/run.sh /run.sh
RUN chmod 755 /*.sh

EXPOSE 3306
ENTRYPOINT ["/run.sh"]

CMD ["mysqld_safe"]
