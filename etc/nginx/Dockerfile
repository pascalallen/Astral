FROM nginx:latest

ENV VIRTUAL_HOST="local.astral.com"
ENV APP_PUBLIC="/var/www/app/public"
ENV PROXY_PASS="astral-fpm:9000"

COPY ./conf/site.conf.template /etc/nginx/conf.d/site.conf.template

RUN rm /etc/nginx/nginx.conf
COPY ./conf/nginx.conf /etc/nginx/nginx.conf

COPY ./init.sh /bin/init.sh
RUN chmod +x /bin/init.sh

RUN useradd -ms /bin/bash astral

CMD ["/bin/init.sh"]
