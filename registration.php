<?php

use Magento\Framework\Component\ComponentRegistrar;

require_once __DIR__ .'/Debug/Resources/functions/dump.php';

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'WeGento_Core',
    __DIR__
);
