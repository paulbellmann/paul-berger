
#!/bin/bash

# Wait for MySQL to be ready
echo "Waiting for MySQL to be available..."
#until mysql -h db -u$MYSQL_USER -p$MYSQL_PASSWORD -e "SELECT 1;" 2>/dev/null; do
#  sleep 2
#done

echo "MySQL is up. Running composer install and creating table."

# Run composer install
cd /var/www/
composer install

# Create table if not exists
mysql -h database -u$MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE <<EOF
CREATE TABLE IF NOT EXISTS item (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL
);
EOF

echo "Setup complete."
