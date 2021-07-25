
#!/bin/bash

set -eux

cd ~/Lantern/lantern
php artisan migrate --force
php artisan config:cache