<?php

namespace TB\Debug;

use Kint\Kint;
use Symfony\Component\VarDumper\VarDumper;
use Kint\Renderer\JsRenderer;

/**
 * @author Thomas Bondois
 */
class VarPrint
{
    const TB_DEBUG_RESTRICTED   = "TB_DEBUG_RESTRICTED";
    const ENV_ALLOWED_ADDRS     = "TB_DEBUG_ALLOWED_ADDRS";

    protected static $isEnabled = true;


    /**
     * Should run html_rich() or cli_rich()
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
     * Should run html_simple() or cli_simple()
     *
     * The output is in text html_rich escaped text
     * with some minor visibility enhancements added.
     * If run in CLI mode, output is not escaped.
     *
     * @see s()
     * @param mixed ...$vars
     * @return int|mixed|null
     */
    public static function simple(...$vars)
    {
        if (!static::isEnabled()) {
            return null;
        }
        $renderer = Kint::MODE_PLAIN;
        if (PHP_SAPI === 'cli' && true === Kint::$cli_detection) {
            $renderer = Kint::MODE_TEXT;
        }
        return static::kint_dump_render($renderer, ...$vars);
    }

    /**
     * The output is dumped to the javascript console and stored in window.kintDump
     * If run in CLI mode, output render is adapted.
     * @see j()
     * @param mixed ...$vars
     *
     * @return string|null
     */
    public static function console(...$vars)
    {
        if (!static::isEnabled()) {
            return null;
        }
        $renderer = JsRenderer::RENDER_MODE;
        if (PHP_SAPI === 'cli' && true === Kint::$cli_detection) {
            $renderer = Kint::MODE_TEXT;
        }
        return static::kint_dump_render($renderer, ...$vars);
    }

    /**
     * content in rich text
     * @param mixed ...$vars
     * @return int|string|null
     */
    public static function html_rich(...$vars)
    {
        return static::kint_dump_render(Kint::MODE_RICH, ...$vars);
    }

    /**
     * content in text text
     * @param mixed ...$vars
     * @return int|string|null
     */
    public static function html_simple(...$vars)
    {
        return static::kint_dump_render(Kint::MODE_PLAIN, ...$vars);
    }

    /**
     * content in rich text (colored lines - some terminal don't manage it properly)
     * @param mixed ...$vars
     * @return int|string|null
     */
    public static function cli_rich(...$vars)
    {
        return static::kint_dump_render(Kint::MODE_CLI, ...$vars);
    }

    /**
     * content in just text
     * @param mixed ...$vars
     * @return int|string|null
     */
    public static function cli_simple(...$vars)
    {
        return static::kint_dump_render(Kint::MODE_TEXT, ...$vars);
    }


    /**
     * Render for js console log Skip cli detection
     * @param mixed ...$vars
     *
     * @return int|string|null
     * @author Thomas Bondois <thomas.bondois@agence-tbd.com>
     */
    public static function console_js(...$vars)
    {
        return static::kint_dump_render(JsRenderer::RENDER_MODE, ...$vars);
    }

    /**
     * @param string $renderer
     * @param mixed ...$vars
     * @return int|string|null
     */
    public static function kint_dump_render($renderer, ...$vars)
    {
        if (!static::isEnabled()) {
            return null;
        }
        Kint::$enabled_mode = $renderer;
        $out = Kint::dump(...$vars);
        Kint::$enabled_mode = true;
        return $out;
    }

    /**
     * use symfony dump() function (in case of problem with Kint), handling isEnabled
     * It will give indication about variable names, backtrace etc. just the content of variables, in black background
     * @param mixed ...$vars
     * @return string|null
     */
    public static function content(...$vars)
    {
        if (!static::isEnabled()) {
            return null;
        }
        foreach ($vars as $var) {
            VarDumper::dump($var);
        }
    }

    public static function isEnabled() : bool
    {
        if (!Access::isAllowed()) {
            static::disable();
        }
        return (bool)static::$isEnabled;
    }

    public static function enable()
    {
        static::setEnabled(true);
    }


    public static function disable()
    {
        static::setEnabled(false);
    }

    /**
     * @param bool $value
     */
    public static function setEnabled($value)
    {
        Kint::$enabled_mode  = static::$isEnabled = (bool)$value;
    }



} // end class
