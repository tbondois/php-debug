PHP Debug
===================

Presentation
---------------

This project is based on [Kint][1] and [VarDumper][2]. I added some features like IP restrictions. 

Installation in a project
---------------

```
composer require tbondois/php-debug --dev
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

debug_print_rich("Kint rich print alias !");
debug_print_simple("Kint simple print alias !");
debug_print_console("Kint browser-console log alias");
debug_print_content("Symfony-VarDumper alias !");
$dump = debug_print_return("Kint return alias");

debug_die_rich("Rich-print and kill script");
debug_die_simple("Simple-print and kill script");
debug_die_console("JS console and kill script");
debug_die_content("Symfony-VarDumper print and kill script");
```


### Access Control (Recommended for Production environments)


#### Disable debug functions in the environment


To ensure this functions will be skipped, define manually in your `$_ENV` a specific variable.
* In Symfony or Laravel or project using `symfony/dotenv`, add this to you `.env` file : 
```
TB_DEBUG_BLOCK_MODE = 1
```
 * Or use the native PHP command  :
```php
putenv("TB_DEBUG_BLOCK_MODE=1");
```
* Or using this library helpers :
```php
\debug_access::setEnvBlockMode(debug_access::MOD_BLOCK_WEB_WHITELIST);
```


#### Disable debug feature in the environment except for some people :


If you want the features being executed for specific IP, add :

* In your `.env` file ;
```
TB_DEBUG_BLOCK_MODE=1
TB_DEBUG_WHITELIST_ADDRS=<IP ADDRESSES>
```
* Or in PHP using native functions :
```php
putenv("TB_DEBUG_BLOCK_MODE=1");
putenv("TB_DEBUG_WHITELIST_ADDRS=<IP ADDRESSES>");
```

* Or using this library helpers :
```php
\debug_access::setEnvBlockMode(\debug_access::MOD_BLOCK_WEB_WHITELIST);
\debug_access::setEnvWhitelistAddrs("<IP ADDRESSES>");
```

You obviously have to replace `<IP ADDRESSES>` by one or more IP addresses separated by comas (`,`). 
It will be compared by the one in `$_SERVER["REMOTE_ADDR"]`.


#### The Blocking Modes :

Suivant la valeur de `TB_DEBUG_BLOCK_MODE` :

* 0 : Blocked nowhere for nobody.
* 1 : Block web for addresses not whitelisted.
* 2 : Blocked in web for everybody
* 4 : Blocked in local terminal
* 5 : (2+1) Blocked in local terminal AND web for addresses not whitelisted.
* 6 : (4 + 2) Blocked everywhere for everybody.


References
---------------

[1]: https://kint-php.github.io/kint/
[2]: https://symfony.com/doc/current/components/var_dumper.html
