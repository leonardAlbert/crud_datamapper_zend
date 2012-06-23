<VirtualHost *:80>
   DocumentRoot "/var/www/datamapper/public"
   ServerName datamapper.local

   # This should be omitted in the production environment
   SetEnv APPLICATION_ENV development

   <Directory "/var/www/datamapper/public">
       Options Indexes MultiViews FollowSymLinks
       AllowOverride All
       Order allow,deny
       Allow from all
   </Directory>

</VirtualHost>
