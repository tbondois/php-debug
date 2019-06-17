<?php

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
    }
    Kint::$aliases[] = 's';
}

// print-rich alias :
if (!function_exists('vp_rich')) {
    function vp_rich(...$args)
    {
        return VarPrint::rich(...$args);
    }
    Kint::$aliases[] = 'vp_rich';
}

// print-simple alias  :
if (!function_exists('vp_simple')) {
    function vp_simple(...$args)
    {
        return VarPrint::simple(...$args);
    }
    Kint::$aliases[] = 'vp_simple';
}

// print-rich and die :
if (!function_exists('kill_vp_rich')) {
    function kill_vp_rich(...$args)
    {
        VarPrint::rich(...$args);
        die("\n/die.\n");
    }
    Kint::$aliases[] = 'kill_vp_rich';
}

// print-simple and die :
if (!function_exists('kill_vp_simple')) {
    function kill_vp_simple(...$args)
    {
        VarPrint::simple(...$args);
        die("\n/die.\n");
    }
    Kint::$aliases[] = 'kill_print_simple';
}


// print-focus() alias :
if (!function_exists('vp_focus')) {
    function vp_focus(...$args)
    {
        return VarPrint::focus(...$args);
    }
}

// print-focus() and die :
if (!function_exists('kill_vp_focus')) {
    function kill_vp_focus(...$args)
    {
        return VarPrint::focus(...$args);
    }
}
