# Static Cache Version

Alters the urls for enqueued CSS and JS files moving the version number from the query string to be part of the file url. 
/file.css?v=123 -> /file.v-123.css 
Requires the following rewrite rules:

**Apache**

    <IfModule mod_rewrite.c>
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^(.+)\.(v-\d+|\d+)\.(js|css|cur|bmp|gif|ico|jpe?g|png|svgz?|webp)$ $1.$3 [L]
    </IfModule>

**Nginx**
add this to a server block

    rewrite ^(.+)\.(v-\d+|\d+)\.(js|css|cur|bmp|gif|ico|jpe?g|png|svgz?|webp)$ $1.$3 last;