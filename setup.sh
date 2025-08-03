#!/bin/bash

cd /var/www/
composer install

mysql -h database -u$MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE <<EOF
CREATE TABLE IF NOT EXISTS item (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL
);
EOF

echo "Setup complete."