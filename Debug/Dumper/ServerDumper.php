<?php

namespace WeGento\Core\Debug\Dumper;

use WeGento\Core\Debug\Cloner\Data;
use WeGento\Core\Debug\Dumper\ContextProvider\ContextProviderInterface;
use WeGento\Core\Debug\Server\Connection;

/**
 * ServerDumper forwards serialized Data clones to a server.
 *
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
 */
class ServerDumper implements DataDumperInterface
{
    private $connection;
    private $wrappedDumper;

    /**
     * @param string                     $host             The server host
     * @param DataDumperInterface|null   $wrappedDumper    A wrapped instance used whenever we failed contacting the server
     * @param ContextProviderInterface[] $contextProviders Context providers indexed by context name
     */
    public function __construct(string $host, DataDumperInterface $wrappedDumper = null, array $contextProviders = [])
    {
        $this->connection = new Connection($host, $contextProviders);
        $this->wrappedDumper = $wrappedDumper;
    }

    public function getContextProviders(): array
    {
        return $this->connection->getContextProviders();
    }

    /**
     * {@inheritdoc}
     */
    public function dump(Data $data)
    {
        if (!$this->connection->write($data) && $this->wrappedDumper) {
            $this->wrappedDumper->dump($data);
        }
    }
}
