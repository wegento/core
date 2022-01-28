<?php

namespace WeGento\Core\Debug\Caster;

use WeGento\Core\Debug\Cloner\Stub;


class DsPairStub extends Stub
{
    public function __construct($key, $value)
    {
        $this->value = [
            Caster::PREFIX_VIRTUAL.'key' => $key,
            Caster::PREFIX_VIRTUAL.'value' => $value,
        ];
    }
}
