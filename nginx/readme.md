

# 使用nginx命令行，不用nginx服务

first edit nginx-site.conf to use proper path
```
    		fastcgi_param SCRIPT_FILENAME /vagrant/www/dolibarr/htdocs$fastcgi_script_name;
```

then 
```
# run nginx:
php bin/console cache:clear 
cd  /vagrant/www/dolibarr-symfony/  && sudo chmod 777 /var/run/php/php7.4-fpm.sock  &&  sudo nginx -c `pwd`/nginx/nginx-site.conf -p "`pwd`"
# then:
curl localhost:8080/user/card
```

```
# shut down
killall nginx
```


# Features

- `.js.php` and `.css.php` are handled by nginx, not Symfony. Related code: 
    1. `->notname('*.js.php')->notname('*.css.php')`
    2. `location ~* \.(css|js)\.php$ {`
