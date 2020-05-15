
# Solution 1 ：不用nginx，直接与 php-fpm 通信
```
# 先修改里面的地址
./cgi.sh
```

# Solution 2: use nginx.exe, not nginx service

## Env
first edit nginx-site.conf to use proper path (this path can not contain ".." )
```
    		fastcgi_param SCRIPT_FILENAME /vagrant/www/dolibarr/htdocs$fastcgi_script_name;
```

## Start

```
# run nginx:
php bin/console cache:clear 
cd  /vagrant/www/dolibarr-symfony/  && sudo chmod 777 /var/run/php/php7.4-fpm.sock  &&  sudo nginx -c `pwd`/nginx-vagrant/nginx-site.conf -p "`pwd`"
# then:
curl localhost:8080/user/card
# or
curl localhost:8080/user/card.php

```

## to use xdebug,  
如果vagrant上面连接不到windows客户端，就在windows上运行端口映射
```
# 原因见 xdebug.vagrant.ini
 "c:\Program Files\Git\usr\bin\ssh.exe"  -i D:\vagrant\ansible\files\key\vagrant\insecure_private_key -g -N -lvagrant -R9002:127.0.0.1:9002 192.168.1.200
```

## shut down
```
killall nginx
```


## mechanism

- `.js.php` and `.css.php` are handled by nginx, not Symfony. Related code: 
    1. `->notname('*.js.php')->notname('*.css.php')`
    2. `location ~* \.(css|js)\.php$ {`
