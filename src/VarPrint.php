<?php

namespace TB\Debug;

use Kint\Kint;

/**
 * @author Thomas Bondois
 */
class VarPrint
{
    const TB_DEBUG_RESTRICTED   = "TB_DEBUG_RESTRICTED";
    const ENV_ALLOWED_ADDRS     = "TB_DEBUG_ALLOWED_ADDRS";

    protected static $isEnabled = true;


    /**
     * Should run rich_html() or rich_cli()
     * @param mixed ...$vars
     * @return int|string|null
     */
    public static function rich(...$vars)
    {
        if (!static::isEnabled()) {
            return null;
        }
        return Kint::dump(...$vars);
    }

    /**
     * Should run simple_html() or simple_cli()
     *
     * The output is in text rich_html escaped text
     * with some minor visibility enhancements added.
     * If run in CLI mode, output is not escaped.
     *
     * @see s()
     * @param mixed ...$vars
     * @return int|mixed
     */
    public static function simple(...$vars)
    {
        if (!static::isEnabled()) {
            return null;
        }
        $stashedMode = Kint::$enabled_mode;
        if (Kint::MODE_TEXT !== Kint::$enabled_mode) {
            Kint::$enabled_mode = Kint::MODE_PLAIN;
            if (PHP_SAPI === 'cli' && true === Kint::$cli_detection) {
                Kint::$enabled_mode = Kint::MODE_TEXT;
            }
        }
        $out = Kint::dump(...$vars);
        Kint::$enabled_mode = $stashedMode;
        return $out;
    }


    /**
     * dump in rich text (colored lines - some terminal don't manage it properly)
     * @param mixed ...$vars
     * @return int|string
     */
    public static function rich_cli(...$vars)
    {
        $stashedMode = Kint::$enabled_mode;
        Kint::$enabled_mode = Kint::MODE_CLI;
        $dump = Kint::dump(...$vars);
        Kint::$enabled_mode = $stashedMode;
        return $dump;
    }

    /**
     * dump in just text
     * @param mixed ...$vars
     * @return int|string
     */
    public static function simple_cli(...$vars)
    {
        if (!static::isEnabled()) {
            return null;
        }
        $stashedMode = Kint::$enabled_mode;
        Kint::$enabled_mode = Kint::MODE_TEXT;
        $dump = Kint::dump(...$vars);
        Kint::$enabled_mode = $stashedMode;
        return $dump;
    }

    /**
     * dump in rich text
     * @param mixed ...$vars
     * @return int|string
     */
    public static function rich_html(...$vars)
    {
        if (!static::isEnabled()) {
            return null;
        }
        $stashedMode = Kint::$enabled_mode;
        Kint::$enabled_mode = Kint::MODE_RICH;
        $dump = Kint::dump(...$vars);
        Kint::$enabled_mode = $stashedMode;
        return $dump;
    }

    /**
     * dump in text text
     * @param mixed ...$vars
     * @return int|string
     */
    public static function simple_html(...$vars)
    {
        if (!static::isEnabled()) {
            return null;
        }
        $stashedMode = Kint::$enabled_mode;
        Kint::$enabled_mode = Kint::MODE_PLAIN;
        $dump = Kint::dump(...$vars);
        Kint::$enabled_mode = $stashedMode;
        return $dump;
    }


    public static function isEnabled()
    {
        if (!Access::isAllowed()) {
            static::setEnabled(false);
        }
        return (bool)static::$isEnabled;
    }

    /**
     * @param bool $value
     */
    public static function setEnabled($value)
    {
        Kint::$enabled_mode  = static::$isEnabled = (bool)$value;
    }

    public static function enable()
    {
        static::setEnabled(true);
    }


    public static function disable()
    {
        static::setEnabled(false);
    }




} // end class
