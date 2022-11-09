FROM schemaspy/schemaspy:6.1.0

ENV TZ=Asia/Tokyo

USER root

COPY schemaspy.properties .

ADD https://repo1.maven.org/maven2/mysql/mysql-connector-java/8.0.30/mysql-connector-java-8.0.30.jar \
    /drivers/mysql-connector-java-8.0.30.jar