
#!/bin/bash

set -eux

cd ~/Lantern/lantern/lantern-ssh-deploy
php artisan migrate --force
php artisan config:cache