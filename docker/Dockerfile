# Build rr binary
FROM spiralscout/roadrunner:latest as rr

# Clone the repository
FROM alpine/git as git

ARG REPOSITORY=https://github.com/metrixio/docker.git
ARG BRANCH=master
RUN git clone -b $BRANCH $REPOSITORY /app

# Configure PHP project
FROM spiralscout/php81-grpc:1.0.0

COPY --from=git /app /app
COPY --from=rr /usr/bin/rr /app

ARG APP_VERSION=v1.0
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer
WORKDIR /app

RUN composer config --no-plugins allow-plugins.spiral/composer-publish-plugin false
RUN composer install --no-dev

EXPOSE 9001/tcp
EXPOSE 2112/tcp

LABEL org.opencontainers.image.source=$REPOSITORY
LABEL org.opencontainers.image.description="MetrixIO Docker"
LABEL org.opencontainers.image.licenses=MIT

CMD ./rr serve
