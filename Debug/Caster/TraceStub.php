<?php

namespace WeGento\Core\Debug\Caster;

use WeGento\Core\Debug\Cloner\Stub;

class TraceStub extends Stub
{
    public $keepArgs;
    public $sliceOffset;
    public $sliceLength;
    public $numberingOffset;

    public function __construct(array $trace, bool $keepArgs = true, int $sliceOffset = 0, int $sliceLength = null, int $numberingOffset = 0)
    {
        $this->value = $trace;
        $this->keepArgs = $keepArgs;
        $this->sliceOffset = $sliceOffset;
        $this->sliceLength = $sliceLength;
        $this->numberingOffset = $numberingOffset;
    }
}
