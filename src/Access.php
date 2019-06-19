<?php

namespace TB\Debug;

/**
 * @author Thomas Bondois
 */
class Access
{
    const ENV_IS_RESTRICTED = "TB_DEBUG_RESTRICTED";
    const ENV_ALLOWED_ADDRS  = "TB_DEBUG_ALLOWED_ADDRS";

    /**
     * Detect if content is permanently blocked
     * @return bool
     */
    public static function isAllowed()
    {
        if (getenv(static::ENV_IS_RESTRICTED)
            || !empty($_SERVER[static::ENV_IS_RESTRICTED])
            || !empty($_GET[static::ENV_IS_RESTRICTED])
        ) {
            $strAllowedAddrs = getenv(static::ENV_ALLOWED_ADDRS) ?? $_SERVER[static::ENV_ALLOWED_ADDRS] ?? null;

            if ($strAllowedAddrs) {
                $clientAddr = $_SERVER["REMOTE_ADDR"] ?? null;
                if (PHP_SAPI === 'cli' && null === $clientAddr) {
                    return true;
                }
                $allowedAddrs = explode(",", $strAllowedAddrs);
                foreach ($allowedAddrs as $allowedAddr) {
                    if ($allowedAddr === $clientAddr) {
                        return true;
                    }
                }
            }
            return false;
        }
        return true;
    }



} // end class
