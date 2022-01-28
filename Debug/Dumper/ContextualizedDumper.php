<?php

namespace WeGento\Core\Debug\Dumper;

use WeGento\Core\Debug\Cloner\Data;
use WeGento\Core\Debug\Dumper\ContextProvider\ContextProviderInterface;

class ContextualizedDumper implements DataDumperInterface
{
    private $wrappedDumper;
    private $contextProviders;

    /**
     * @param ContextProviderInterface[] $contextProviders
     */
    public function __construct(DataDumperInterface $wrappedDumper, array $contextProviders)
    {
        $this->wrappedDumper = $wrappedDumper;
        $this->contextProviders = $contextProviders;
    }

    public function dump(Data $data)
    {
        $context = [];
        foreach ($this->contextProviders as $contextProvider) {
            $context[\get_class($contextProvider)] = $contextProvider->getContext();
        }

        $this->wrappedDumper->dump($data->withContext($context));
    }
}
