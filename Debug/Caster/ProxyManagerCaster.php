<?php

namespace WeGento\Core\Debug\Caster;

use ProxyManager\Proxy\ProxyInterface;
use WeGento\Core\Debug\Cloner\Stub;

class ProxyManagerCaster
{
    public static function castProxy(ProxyInterface $c, array $a, Stub $stub, bool $isNested)
    {
        if ($parent = get_parent_class($c)) {
            $stub->class .= ' - '.$parent;
        }
        $stub->class .= '@proxy';

        return $a;
    }
}
