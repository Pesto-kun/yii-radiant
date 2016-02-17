Project install
===============================

1. Execute the `init` command and select `dev` as environment.

   ```
   php /path/to/yii-application/init
   ```

   Otherwise, in production execute `init` in non-interactive mode.

   ```
   php /path/to/yii-application/init --env=Production --overwrite=All
   ```

2. Create a new mysql database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.

3. Create a new mongodb database and adjust the `components['mongodb']` configuration in `common/config/main-local.php` accordingly.

4. Get SMTP account data and Adjust the `components['mailer']` configuration in `common/config/main-local.php` accordingly.

5. Fill `hostInfo` and `baseUrl` in  `components['urlManager']` configuration in `common/config/main-local.php` accordingly.

6. Apply migrations with console command `yii migrate`.

7. Set document roots of your web server:

   - for frontend `/path/to/yii-application/frontend/web/` and using the URL `http://site.com/`
   - for backend `/path/to/yii-application/backend/web/` and using the URL `http://admin.site.com/`

   For Apache it could be the following:

   ```apache
       <VirtualHost *:80>
           ServerName site.com
           DocumentRoot "/path/to/yii-application/frontend/web/"

           <Directory "/path/to/yii-application/frontend/web/">
               # use mod_rewrite for pretty URL support
               RewriteEngine on
               # If a directory or a file exists, use the request directly
               RewriteCond %{REQUEST_FILENAME} !-f
               RewriteCond %{REQUEST_FILENAME} !-d
               # Otherwise forward the request to index.php
               RewriteRule . index.php

               # use index.php as index file
               DirectoryIndex index.php

               # ...other settings...
           </Directory>
       </VirtualHost>

       <VirtualHost *:80>
           ServerName admin.site.com
           DocumentRoot "/path/to/yii-application/backend/web/"

           <Directory "/path/to/yii-application/backend/web/">
               # use mod_rewrite for pretty URL support
               RewriteEngine on
               # If a directory or a file exists, use the request directly
               RewriteCond %{REQUEST_FILENAME} !-f
               RewriteCond %{REQUEST_FILENAME} !-d
               # Otherwise forward the request to index.php
               RewriteRule . index.php

               # use index.php as index file
               DirectoryIndex index.php

               # ...other settings...
           </Directory>
       </VirtualHost>
   ```

   For nginx:

   ```nginx
       server {
           charset utf-8;
           client_max_body_size 128M;

           listen 80; ## listen for ipv4
           #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

           server_name site.com;
           root        /path/to/yii-application/frontend/web/;
           index       index.php;

           access_log  /path/to/yii-application/log/frontend-access.log;
           error_log   /path/to/yii-application/log/frontend-error.log;

           location / {
               # Redirect everything that isn't a real file to index.php
               try_files $uri $uri/ /index.php?$args;
           }

           # uncomment to avoid processing of calls to non-existing static files by Yii
           #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
           #    try_files $uri =404;
           #}
           #error_page 404 /404.html;

           location ~ \.php$ {
               include fastcgi_params;
               fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
               fastcgi_pass   127.0.0.1:9000;
               #fastcgi_pass unix:/var/run/php5-fpm.sock;
               try_files $uri =404;
           }

           location ~ /\.(ht|svn|git) {
               deny all;
           }
       }

       server {
           charset utf-8;
           client_max_body_size 128M;

           listen 80; ## listen for ipv4
           #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

           server_name admin.site.com;
           root        /path/to/yii-application/backend/web/;
           index       index.php;

           access_log  /path/to/yii-application/log/backend-access.log;
           error_log   /path/to/yii-application/log/backend-error.log;

           location / {
               # Redirect everything that isn't a real file to index.php
               try_files $uri $uri/ /index.php?$args;
           }

           # uncomment to avoid processing of calls to non-existing static files by Yii
           #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
           #    try_files $uri =404;
           #}
           #error_page 404 /404.html;

           location ~ \.php$ {
               include fastcgi_params;
               fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
               fastcgi_pass   127.0.0.1:9000;
               #fastcgi_pass unix:/var/run/php5-fpm.sock;
               try_files $uri =404;
           }

           location ~ /\.(ht|svn|git) {
               deny all;
           }
       }
   ```

8. Add cron schedule
   ```
   * *      * * *   root    /path/to/yii-application/yii cron/action
   ```