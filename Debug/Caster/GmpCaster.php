<?php

namespace WeGento\Core\Debug\Caster;

use WeGento\Core\Debug\Cloner\Stub;

class GmpCaster
{
    public static function castGmp(\GMP $gmp, array $a, Stub $stub, bool $isNested, int $filter): array
    {
        $a[Caster::PREFIX_VIRTUAL.'value'] = new ConstStub(gmp_strval($gmp), gmp_strval($gmp));

        return $a;
    }
}
