<?php

namespace WeGento\Core\Debug\Caster;

use WeGento\Core\Debug\Cloner\Stub;

class ConstStub extends Stub
{
    public function __construct(string $name, $value = null)
    {
        $this->class = $name;
        $this->value = 1 < \func_num_args() ? $value : $name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }
}
