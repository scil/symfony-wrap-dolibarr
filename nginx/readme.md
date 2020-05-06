

# 使用nginx命令行，不用nginx服务

```
# run nginx:
cd  /vagrant/www/dolibarr-symfony/  && sudo chmod 777 /var/run/php/php7.4-fpm.sock  &&  sudo nginx -c `pwd`/nginx/nginx-site.conf -p "`pwd`"
# then:
curl localhost:8080/user/card
```

```
# shut down
killall nginx
```
