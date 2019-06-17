<?php

use Kint\Kint;
use TB\Debug\VarPrint;

// adapting the King native d() alias :
if (!function_exists('d')) {
    function d(...$args)
    {
        return VarPrint::rich(...$args);
    }
    Kint::$aliases[] = 'd';
}

// adapting the King native s() alias
if (!function_exists('s')) {
    function s(...$args)
    {
        return VarPrint::simple(...$args);
        die("/DIE");
    }
    Kint::$aliases[] = 's';
}

// print-rich and die :
if (!function_exists('dd')) {
    function dd(...$args)
    {
        VarPrint::rich(...$args);
        die("\n/die.\n");
    }
    Kint::$aliases[] = 'dd';
}

// print-simple and die :
if (!function_exists('sd')) {
    function sd(...$args)
    {
        VarPrint::simple(...$args);
        die("\n/die.\n");
    }
    Kint::$aliases[] = 'sd';
}

// print-rich extra alias :
if (!function_exists('vpr')) {
    function vpr(...$args)
    {
        return VarPrint::rich(...$args);
    }
    Kint::$aliases[] = 'vpr';
}

// print-simple extra alias  :
if (!function_exists('vps')) {
    function vps(...$args)
    {
        return VarPrint::simple(...$args);
    }
    Kint::$aliases[] = 'vps';
}
