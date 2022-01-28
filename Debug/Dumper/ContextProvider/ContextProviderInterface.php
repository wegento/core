<?php

namespace WeGento\Core\Debug\Dumper\ContextProvider;

interface ContextProviderInterface
{
    /**
     * @return array|null Context data or null if unable to provide any context
     */
    public function getContext(): ?array;
}
