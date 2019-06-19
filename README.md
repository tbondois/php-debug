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

VarPrint::rich("Kint rich print in hmtl or terminal");
VarPrint::simple("Kint simple print in hmtl or terminal");
VarPrint::content("Symfony-VarDumper print");
VarPrint::console("Kint log in browser JS console, or terminal");
$dump = VarPrint::return("Kint log in browser JS console!"); // do not print but return, to use in a log file for example


print_rich("Kint rich print Alias !");
print_simple("Kint simple print alias !");
print_content("Symfony-VarDumper alias !");
print_console("Kint browser-console log alias");
print_return("Kint return alias");

die_rich("Rich-print and kill script");
die_simple("Simple-print and kill script");
die_content("Symfony-VarDumper print and kill script");
die_console("JS console and kill script");
```


### Access Control (Recommended for Production environments)

- To ensure this functions will be skipped, define manually in your `$_ENV` or `$_SERVER ` :

```
TB_DEBUG_RESTRICTED = true
```

- If you want the features being executed for specific IP, define in `.env` file or `$_SERVER `:
```
TB_DEBUG_RESTRICTED = true
TB_DEBUG_ALLOWED_ADDRS = "<IP ADDRESSES>"
```


You should then replace <IP ADDRESSES> by one or mroe separated by comas (`,`). It will be compared by the one in `$_SERVER["REMOTE_ADDR"]`.



References
---------------

[1]: https://kint-php.github.io/kint/
[2]: https://symfony.com/doc/current/components/var_dumper.html
