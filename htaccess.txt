# Rewrite Rules php file as a directory /
RewriteEngine on 
RewriteRule ^(.*)/$ $1.php
#


# php interpreter for some other file extensions
AddType application/x-httpd-php .tpl
#


# Deny Rules for file extensions
<FilesMatch "\.(sqlite|sdb|s3db|db|txt)$">
 Deny from all
</FilesMatch>
#