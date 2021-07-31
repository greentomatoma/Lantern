
#!/bin/bash

set -eux

cd ~/Lantern/lantern/lantern/lantern
php artisan migrate --force
php artisan config:cache