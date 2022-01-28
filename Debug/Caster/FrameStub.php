<?php
namespace WeGento\Core\Debug\Caster;

class FrameStub extends EnumStub
{
    public $keepArgs;
    public $inTraceStub;

    public function __construct(array $frame, bool $keepArgs = true, bool $inTraceStub = false)
    {
        $this->value = $frame;
        $this->keepArgs = $keepArgs;
        $this->inTraceStub = $inTraceStub;
    }
}
