
#!/bin/bash

set -eux

cd ~/Lantern/lantern-ssh-deploy
php artisan migrate --force
php artisan config:cache