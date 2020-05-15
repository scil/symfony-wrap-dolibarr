

# How do
- use `Legacy Route Loader` at [Migrating an Existing Application to Symfony](https://symfony.com/doc/current/migration.html#booting-symfony-in-a-front-controller), not the simper one `Front Controller with Legacy Bridge`.

- dolibarr global vars are defined before require dolibarr script. Why?

- use `error_reporting`  to ignore E_DEPRECATED

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

# todo
- [ ] find a way to define all dolibarr global vars in `loadLegacyScript`
- [ ] Symfony �Ჶ׽�������Ĵ��� $message = "Array and string offset access syntax with curly braces is deprecated"  ��κ���֮��