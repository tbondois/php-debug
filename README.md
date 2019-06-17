PHP Debug
===================

Presentation
---------------

This project is based on [Kint][1] and [VarDumper][2]. I added some features like IP restrictions. 

Installation in a project
---------------

### In development environment only (Recommended) :

```
composer require tbondois/php-debug -- dev
```

### In production :

```
composer require tbondois/php-debug
```


Update it  in a project
---------------

```
composer update tbondois/php-debug
```

Usage
---------------


### Inclusion and basic usage 

```php
include_once 'vendor/autoload.php';
use TB\Debug\VarPrint;

VarPrint::rich("Kint rich print");
VarPrint::simple("Kint simple print");
VarPrint::focus("VarDumper print");

vp_rich("Rich print Alias !");
vp_simple("Simple print alias !");
vp_focus("VarDumper print alias !");

kill_vp_rich("Rich-print and kill script");
kill_vp_simple("Simple-print and kill script");
vp_focus("VarDumper print and kill script");
```


### Access Control (Recommended for Production environments)

- To ensure this functions will be skipped, define manually in your `$_ENV` or `$_SERVER ` :

```
TB_DEBUG_RESTRICTED = true
```

- If you want the features being executed for specific IP, define in your `$_ENV` or `$_SERVER `:
```
TB_DEBUG_RESTRICTED = true
TB_DEBUG_ALLOWED_ADDRS = "<IP ADDRESSES>"
```


You should then replace <IP ADDRESSES> by one or mroe separated by comas (`,`). It will be compared by the one in `$_SERVER["REMOTE_ADDR"]`.



References
---------------

[1]: https://kint-php.github.io/kint/
[2]: https://symfony.com/doc/current/components/var_dumper.html
