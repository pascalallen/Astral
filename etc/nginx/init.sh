#!/bin/bash

set -e

cd /etc/nginx/conf.d/

sed -i.bak \
    -e "s@{{hostname}}@$VIRTUAL_HOST@g" \
    -e "s@{{path}}@$APP_PUBLIC@g" \
    -e "s@{{proxy_pass}}@$PROXY_PASS@g" ./site.conf.template \
    && rm ./site.conf.template.bak \
    && mv ./site.conf.template ./site.conf

nginx -g "daemon off;"
