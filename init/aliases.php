<?php

use Kint\Kint;
use TB\Debug\VarPrint;

if (!function_exists('d')) {
    function d(...$args)
    {
        return VarPrint::rich(...$args);
    }

    Kint::$aliases[] = 'd';
}

if (!function_exists('dd')) {
    function dd(...$args)
    {
        return VarPrint::rich(...$args);
    }

    Kint::$aliases[] = 'dd';
}

if (!function_exists('s')) {
    function s(...$args)
    {
        return VarPrint::simple(...$args);
    }

    Kint::$aliases[] = 's';
}

if (!function_exists('sd')) {
    function sd(...$args)
    {
        return VarPrint::simple(...$args);
    }

    Kint::$aliases[] = 'sd';
}
