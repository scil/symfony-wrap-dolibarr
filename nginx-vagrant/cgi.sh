# 不用nginx，直接与 php-fpm 通信

# sudo apt-get install libfcgi0ldbl
# sudo chmod 777 /run/php/php7.3-fpm.sock
# 教程:
#   https://www.gregfreeman.io/2016/how-to-connect-to-php-fpm-directly-to-resolve-issues-with-blank-pages/
#   https://easyengine.io/tutorials/php/directly-connect-php-fpm/
#
# 除了 cgi-fcgi 另一种办法是用python
#   https://stackoverflow.com/questions/26644607/python-emulate-the-functionality-of-cgi-fcgi-program
#   https://stackoverflow.com/questions/6801673/python-fastcgi-client

DOCUMENT_ROOT=/vagrant/www/dolibarr-symfony/public


SCRIPT_NAME=/index.php
FILENAME=$DOCUMENT_ROOT/index.php


# 很多变量不是必须的，但如果脚本中访问诸如 $_SERVER['SERVER_PORT'] 如果没有设置这个变量，就会出错: Undefined index: SERVER_PORT
# 参考:
#   如何使用cgi-fcgi命令访问php-fpm实现HTTP请求
#   https://my.oschina.net/u/222608/blog/1345626
SCRIPT_FILENAME=$FILENAME \
SCRIPT_NAME=$FILENAME \
REQUEST_URI=/ \
QUERY_STRING= \
REQUEST_METHOD=GET \
SERVER_ADDR=127.0.0.1 \
SERVER_PORT=80 \
SERVER_NAME=localhost \
HTTP_HOST=localhost \
cgi-fcgi -bind -connect /run/php/php7.4-fpm.sock 