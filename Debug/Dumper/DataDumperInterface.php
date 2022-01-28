<?php

namespace WeGento\Core\Debug\Dumper;

use WeGento\Core\Debug\Cloner\Data;

interface DataDumperInterface
{
    public function dump(Data $data);
}
