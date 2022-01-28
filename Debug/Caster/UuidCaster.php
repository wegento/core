<?php

namespace WeGento\Core\Debug\Caster;

use Ramsey\Uuid\UuidInterface;
use WeGento\Core\Debug\Cloner\Stub;

final class UuidCaster
{
    public static function castRamseyUuid(UuidInterface $c, array $a, Stub $stub, bool $isNested): array
    {
        $a += [
            Caster::PREFIX_VIRTUAL.'uuid' => (string) $c,
        ];

        return $a;
    }
}
