
use `Legacy Route Loader` at [Migrating an Existing Application to Symfony](https://symfony.com/doc/current/migration.html#booting-symfony-in-a-front-controller)

# Start

just a basic test, no support of css/js/png/...
```
php bin/console cache:clear 
symfony.exe server:start
curl http://localhost:8000/user/card.php
# or if DOLIBARR_STYLE_URL=0
curl http://localhost:8000/user/card
```

# To support png/css and `.js.php`, `.css.php`?  

see  Solution 2 in  `nginx-vagrant/readme.md`

# Err?

route not found?
```
php bin/console cache:clear
```

