FROM nginx:alpine

SHELL ["/bin/ash", "-oeux", "pipefail", "-c"]

ENV TZ=Asia/Tokyo

COPY ./default.conf /etc/nginx/conf.d/

WORKDIR /var/www/html