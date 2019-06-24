<?php

use TB\Debug\DebugPrint;
use Kint\Kint;

class_alias("TB\\Debug\\DebugPrint", "debug_print");
class_alias("TB\\Debug\\Access"    , "debug_access");

// adapting the King native d() alias :
$kintAlias = 'd';
if (!function_exists($kintAlias)) {
    function d(...$args)
    {
        return DebugPrint::rich(...$args);
    }
    Kint::$aliases[] = $kintAlias;
}

// adapting the King native s() alias
$kintAlias = 's';
if (!function_exists($kintAlias)) {
    function s(...$args)
    {
        return DebugPrint::simple(...$args);
    }
    Kint::$aliases[] = $kintAlias;
}

// adapting the King native j() alias
$kintAlias = 'j';
if (!function_exists($kintAlias)) {
    function j(...$args)
    {
        return DebugPrint::console(...$args);
    }
    Kint::$aliases[] = $kintAlias;
}

// print-rich alias :
$kintAlias = 'debug_print_rich';
if (!function_exists($kintAlias)) {
    function debug_print_rich(...$args)
    {
        return DebugPrint::rich(...$args);
    }
    Kint::$aliases[] = $kintAlias;
}

// print-simple alias  :
$kintAlias = 'debug_print_simple';
if (!function_exists($kintAlias)) {
    function debug_print_simple(...$args)
    {
        return DebugPrint::simple(...$args);
    }
    Kint::$aliases[] = $kintAlias;
}

// print-console (js) alias  :
$kintAlias = 'debug_print_console';
if (!function_exists($kintAlias)) {
    function debug_print_console(...$args)
    {
        return DebugPrint::console(...$args);
    }
    Kint::$aliases[] = $kintAlias;
}


// Sf dump alias :
if (!function_exists('debug_print_content')) {
    function debug_print_content(...$args)
    {
        return DebugPrint::content(...$args);
    }
}

// Return Kint text alias :
$kintAlias = 'debug_print_return';
if (!function_exists($kintAlias)) {
    function debug_print_return(...$args)
    {
        return DebugPrint::return(...$args);
    }
    Kint::$aliases[] = $kintAlias;
}

// print-rich and die :
$kintAlias = 'debug_die_rich';
if (!function_exists($kintAlias)) {
    function debug_die_rich(...$args)
    {
        DebugPrint::rich(...$args);
        die("\n\n/".__FUNCTION__.".\n\n");
    }
    Kint::$aliases[] = $kintAlias;
}

// print-simple and die :
$kintAlias = 'debug_die_simple';
if (!function_exists($kintAlias)) {
    function debug_die_simple(...$args)
    {
        DebugPrint::simple(...$args);
        die("\n\n/".__FUNCTION__.".\n\n");
    }
    Kint::$aliases[] = $kintAlias;
}

// print-console and die :
$kintAlias = 'debug_die_console';
if (!function_exists($kintAlias)) {
    function debug_die_console(...$args)
    {
        DebugPrint::console(...$args);
        die("\n\n/".__FUNCTION__.".\n\n");
    }
    Kint::$aliases[] = $kintAlias;
}

// Sf dump and die :
if (!function_exists('debug_die_content')) {
    function debug_die_content(...$args)
    {
        return DebugPrint::content(...$args);
        die("\n\n/".__FUNCTION__.".\n\n");
    }
}

unset($kintAlias);
