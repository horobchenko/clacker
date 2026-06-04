# Deployment Guide

## Prerequisites

Before deploying, ensure you have:

- VPS/Server with PHP 8.1+, Node.js 16+
- MySQL 8.0+ or PostgreSQL 12+
- nginx or Apache web server
- SSH access to server
- Domain name (optional but recommended)
- SSL certificate (Let's Encrypt recommended)

## Server Setup

### 1. Install System Dependencies

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP and extensions
sudo apt install php8.2-cli php8.2-fpm php8.2-mysql php8.2-pgsql \
  php8.2-gd php8.2-curl php8.2-zip php8.2-xml -y

# Install Node.js
sudo curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install nodejs -y

# Install Composer
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

# Install MySQL
sudo apt install mysql-server -y

# Install nginx
sudo apt install nginx -y
```

### 2. Create Application Directory

```bash
sudo mkdir -p /var/www/clacker
sudo chown -R $USER:$USER /var/www/clacker
cd /var/www/clacker
```

### 3. Clone Repository

```bash
git clone https://github.com/horobchenko/clacker.git .
```

### 4. Install Dependencies

```bash
# PHP dependencies
composer install --optimize-autoloader --no-dev

# JavaScript dependencies
npm ci --production
```

### 5. Configure Application

```bash
# Copy environment file
cp .env.example .env

# Set encryption key
php artisan key:generate

# Update .env with production settings
# Set: APP_ENV=production, APP_DEBUG=false
# Set database credentials
# Set APP_URL to your domain
```

### 6. Database Setup

```bash
# Create database
mysql -u root -p << EOF
CREATE DATABASE clacker;
CREATE USER 'clacker_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON clacker.* TO 'clacker_user'@'localhost';
FLUSH PRIVILEGES;
EOF
```

### 7. Build Frontend Assets

```bash
npm run build
```

### 8. Run Migrations

```bash
php artisan migrate --force
```

## Web Server Configuration

### Nginx Configuration

Create `/etc/nginx/sites-available/clacker`:

```nginx
server {
    listen 80;
    server_name your-domain.com www.your-domain.com;

    root /var/www/clacker/public;
    index index.php;

    # Logging
    access_log /var/log/nginx/clacker_access.log;
    error_log /var/log/nginx/clacker_error.log;

    # Security headers
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

Enable site:

```bash
sudo ln -s /etc/nginx/sites-available/clacker /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

### Enable HTTPS with Let's Encrypt

```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot certonly --nginx -d your-domain.com -d www.your-domain.com
```

Update nginx config to redirect HTTP to HTTPS:

```nginx
server {
    listen 80;
    server_name your-domain.com www.your-domain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name your-domain.com www.your-domain.com;
    
    ssl_certificate /etc/letsencrypt/live/your-domain.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/your-domain.com/privkey.pem;
    
    # ... rest of configuration
}
```

## PHP Configuration

Edit `/etc/php/8.2/fpm/php.ini`:

```ini
post_max_size = 20M
upload_max_filesize = 20M
max_execution_time = 60
memory_limit = 256M
```

Restart PHP-FPM:

```bash
sudo systemctl restart php8.2-fpm
```

## Permissions

```bash
cd /var/www/clacker

# Set directory permissions
sudo chown -R www-data:www-data .
sudo chmod -R 755 .

# Set write permissions for storage and bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

## Process Management

### Start PHP-FPM and Nginx

```bash
sudo systemctl start php8.2-fpm
sudo systemctl start nginx
sudo systemctl start mysql
```

### Enable on Boot

```bash
sudo systemctl enable php8.2-fpm
sudo systemctl enable nginx
sudo systemctl enable mysql
```

## Monitoring & Maintenance

### View Logs

```bash
# Application logs
tail -f /var/www/clacker/storage/logs/laravel.log

# Nginx logs
sudo tail -f /var/log/nginx/clacker_error.log

# PHP logs
sudo tail -f /var/log/php8.2-fpm.log
```

### Database Backups

```bash
# Daily backup script
sudo tee /usr/local/bin/backup-clacker.sh << 'EOF'
#!/bin/bash
BACKUP_DIR="/backups/clacker"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
mysqldump -u clacker_user -p'password' clacker > "$BACKUP_DIR/clacker_$TIMESTAMP.sql"
EOF

sudo chmod +x /usr/local/bin/backup-clacker.sh

# Add to crontab
sudo crontab -e
# Add: 0 2 * * * /usr/local/bin/backup-clacker.sh
```

### Auto-renewal of SSL Certificates

```bash
sudo certbot renew --dry-run  # Test
sudo certbot renew             # Actual renewal
```

Create cron job:

```bash
0 12 * * * /usr/bin/certbot renew --quiet
```

## Performance Optimization

### Enable Caching

Update `.env`:

```env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
```

Install Redis:

```bash
sudo apt install redis-server -y
sudo systemctl start redis-server
```

### Enable Query Caching

```env
DATABASE_QUERY_CACHE=true
```

### Optimize Autoloader

```bash
composer dump-autoload --optimize
```

### Laravel Optimization

```bash
php artisan optimize
php artisan config:cache
php artisan route:cache
```

## Deployment Checklist

- [ ] Clone repository
- [ ] Install dependencies (composer, npm)
- [ ] Copy and configure .env
- [ ] Generate application key
- [ ] Create database and user
- [ ] Run migrations
- [ ] Build frontend assets
- [ ] Set proper file permissions
- [ ] Configure web server (nginx/Apache)
- [ ] Enable HTTPS/SSL
- [ ] Set up monitoring and logging
- [ ] Configure backups
- [ ] Test application in browser
- [ ] Set up monitoring alerts

## Continuous Deployment

For automated deployments, use GitHub Actions or similar CI/CD:

```yaml
name: Deploy
on:
  push:
    branches: [main, master]

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Deploy
        run: |
          ssh user@server 'cd /var/www/clacker && \
            git pull && \
            composer install --no-dev && \
            npm ci && \
            npm run build && \
            php artisan migrate --force'
```
