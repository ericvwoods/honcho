#!/bin/sh
# Upload folders are mounted from the host, which hides what the image has
# there. Copy the committed files back in on every start (this updates
# them and never deletes an upload) and give the folders to Apache's user.
set -e
grep -v '^#' /opt/honcho-seed/dirs | while read -r d; do
    [ -n "$d" ] || continue
    mkdir -p "/var/www/html/$d"
    cp -a "/opt/honcho-seed/$d/." "/var/www/html/$d/"
    chown www-data:www-data "/var/www/html/$d"
done
exec docker-php-entrypoint "$@"
