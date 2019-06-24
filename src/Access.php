<?php

namespace TB\Debug;

/**
 * @author Thomas Bondois
 */
class Access
{
    const KEY_BLOCK_MODE            = "TB_DEBUG_BLOCK_MODE";
    const KEY_WHITELIST_ADDRS       = "TB_DEBUG_WHITELIST_ADDRS";

    const MOD_BLOCK_WEB_WHITELIST   = 1;
    const MOD_BLOCK_WEB_ALL         = 2;
    const MOD_BLOCK_CLI             = 4;

    /**
     * Detect if content is permanently blocked
     * @return bool
     */
    public static function isAllowed()
    {

        $confRestricted = getenv(static::KEY_BLOCK_MODE) ?? $_SERVER[static::KEY_BLOCK_MODE] ?? $_GET[static::KEY_BLOCK_MODE];
        $confRestricted = (int)$confRestricted;
        if ($confRestricted > 0) {

            $clientAddr = $_SERVER["REMOTE_ADDR"] ?? null;

            $isCli = PHP_SAPI === 'cli';
            if ($isCli) {
                if ($confRestricted & static::MOD_BLOCK_CLI) {
                    return false;
                } elseif (null === $clientAddr) {
                    return true;
                }
            }

            if ($confRestricted & static::MOD_BLOCK_WEB_ALL) {
                return false;
            } elseif ($confRestricted & static::MOD_BLOCK_WEB_WHITELIST) {
                $allowedAddrs = static::getEnvWhitelistAddrs();
                foreach ($allowedAddrs as $allowedAddr) {
                    if (!empty($allowedAddr) && $allowedAddr === $clientAddr) {
                        return true;
                    }
                }
            }
            return false;
        }
        return true;
    }


    /**
     * @return int
     */
    public static function getEnvBlockMode() : int
    {
        return (int)getenv(static::KEY_BLOCK_MODE);
    }

    /**
     * @param int $mode
     * @return bool
     */
    public static function setEnvBlockMode(int $mode)
    {
        return putenv(static::KEY_BLOCK_MODE."=".$mode);
    }


    /**
     * @return array
     */
    public static function getEnvWhitelistAddrs() : array
    {
        $confAllowedAddrs = getenv(static::KEY_WHITELIST_ADDRS) ?? '';
        $aAddrs = [];
        if (!empty($confAllowedAddrs)) {
            if ($confAllowedAddrs) {
                $aAddrs = explode(",", $confAllowedAddrs);
            }
            if (!is_array($aAddrs)) {
                $aAddrs = [$aAddrs];
            }
        }
        return $aAddrs;
    }

    /**
     * @param string|array $addrs
     * @return bool
     */
    public static function setEnvWhitelistAddrs($addrs)
    {
        if (is_array($addrs)) {
            $addrs = implode(",", $addrs);
        }
        return putenv(static::KEY_WHITELIST_ADDRS."=".$addrs);
    }


    /**
     * @param string $addr
     * @return bool
     */
    public static function addEnvWhitelistAddr(string $addr)
    {
        $addrs = static::getEnvWhitelistAddrs();
        $addrs[] = $addr;
        return static::setEnvWhitelistAddrs($addrs);
    }


} // end class
