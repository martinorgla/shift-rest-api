FROM mysql:5.7
ENV MYSQL_ALLOW_EMPTY_PASSWORD="yes"
ENV MYSQL_USER="user"
ENV MYSQL_PASSWORD="password"
ENV MYSQL_DATABASE="database"

VOLUME "/var/lib/mysql"

COPY initdb.sql /docker-entrypoint-initdb.d/initdb.sql

EXPOSE 3306
