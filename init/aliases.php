<?php

use TB\Debug\VarPrint;

class_alias('TB\\Debug\\VarPrint', 'varprint');

// adapting the King native d() alias :
$kintAlias = 'd';
if (!function_exists($kintAlias)) {
    function d(...$args)
    {
        return VarPrint::rich(...$args);
    }
    Kint::$aliases[] = $kintAlias;
}

// adapting the King native s() alias
$kintAlias = 's';
if (!function_exists($kintAlias)) {
    function s(...$args)
    {
        return VarPrint::simple(...$args);
    }
    Kint::$aliases[] = $kintAlias;
}

// adapting the King native j() alias
$kintAlias = 'j';
if (!function_exists($kintAlias)) {
    function j(...$args)
    {
        return VarPrint::console(...$args);
    }
    Kint::$aliases[] = $kintAlias;
}

// print-rich alias :
$kintAlias = 'print_rich';
if (!function_exists($kintAlias)) {
    function print_rich(...$args)
    {
        return VarPrint::rich(...$args);
    }
    Kint::$aliases[] = $kintAlias;
}

// print-simple alias  :
$kintAlias = 'print_simple';
if (!function_exists($kintAlias)) {
    function print_simple(...$args)
    {
        return VarPrint::simple(...$args);
    }
    Kint::$aliases[] = $kintAlias;
}

// print-console (js) alias  :
$kintAlias = 'print_console';
if (!function_exists($kintAlias)) {
    function print_console(...$args)
    {
        return VarPrint::console(...$args);
    }
    Kint::$aliases[] = $kintAlias;
}


// Return Kint text alias :
$kintAlias = 'print_return';
if (!function_exists($kintAlias)) {
    function print_return(...$args)
    {
        return VarPrint::return(...$args);
    }
    Kint::$aliases[] = $kintAlias;
}

// Sf dump alias :
if (!function_exists('print_content')) {
    function print_content(...$args)
    {
        return VarPrint::content(...$args);
    }
}

// print-rich and die :
$kintAlias = 'die_rich';
if (!function_exists($kintAlias)) {
    function die_rich(...$args)
    {
        VarPrint::rich(...$args);
        die("\n\n/".__FUNCTION__.".\n\n");
    }
    Kint::$aliases[] = $kintAlias;
}

// print-simple and die :
$kintAlias = 'die_simple';
if (!function_exists($kintAlias)) {
    function die_simple(...$args)
    {
        VarPrint::simple(...$args);
        die("\n\n/".__FUNCTION__.".\n\n");
    }
    Kint::$aliases[] = $kintAlias;
}

// print-console and die :
$kintAlias = 'die_console';
if (!function_exists($kintAlias)) {
    function die_console(...$args)
    {
        VarPrint::console(...$args);
        die("\n\n/".__FUNCTION__.".\n\n");
    }
    Kint::$aliases[] = $kintAlias;
}

// Sf dump and die :
if (!function_exists('die_content')) {
    function die_content(...$args)
    {
        return VarPrint::content(...$args);
        die("\n\n/".__FUNCTION__.".\n\n");
    }
}

unset($kintAlias);
