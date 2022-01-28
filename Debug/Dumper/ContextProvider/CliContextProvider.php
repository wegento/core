<?php

namespace WeGento\Core\Debug\Dumper\ContextProvider;

final class CliContextProvider implements ContextProviderInterface
{
    public function getContext(): ?array
    {
        if ('cli' !== \PHP_SAPI) {
            return null;
        }

        return [
            'command_line' => $commandLine = implode(' ', $_SERVER['argv'] ?? []),
            'identifier' => hash('crc32b', $commandLine.$_SERVER['REQUEST_TIME_FLOAT']),
        ];
    }
}
