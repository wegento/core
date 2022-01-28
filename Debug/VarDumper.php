<?php

namespace WeGento\Core\Debug;

use WeGento\Core\Debug\Caster\ReflectionCaster;
use WeGento\Core\Debug\Cloner\VarCloner;
use WeGento\Core\Debug\Dumper\CliDumper;
use WeGento\Core\Debug\Dumper\ContextProvider\SourceContextProvider;
use WeGento\Core\Debug\Dumper\ContextualizedDumper;
use WeGento\Core\Debug\Dumper\HtmlDumper;

// Load the global dump() function
//require_once __DIR__.'/Resources/functions/dump.php';

class VarDumper
{
    private static $handler;

    public static function dump($var)
    {
        if (null === self::$handler) {
            $cloner = new VarCloner();
            $cloner->addCasters(ReflectionCaster::UNSET_CLOSURE_FILE_INFO);

            if (isset($_SERVER['VAR_DUMPER_FORMAT'])) {
                $dumper = 'html' === $_SERVER['VAR_DUMPER_FORMAT'] ? new HtmlDumper() : new CliDumper();
            } else {
                $dumper = \in_array(\PHP_SAPI, ['cli', 'phpdbg']) ? new CliDumper() : new HtmlDumper();
            }

            $dumper = new ContextualizedDumper($dumper, [new SourceContextProvider()]);

            self::$handler = function ($var) use ($cloner, $dumper) {
                $dumper->dump($cloner->cloneVar($var));
            };
        }

        return (self::$handler)($var);
    }

    public static function setHandler(callable $callable = null)
    {
        $prevHandler = self::$handler;

        // Prevent replacing the handler with expected format as soon as the env var was set:
        if (isset($_SERVER['VAR_DUMPER_FORMAT'])) {
            return $prevHandler;
        }

        self::$handler = $callable;

        return $prevHandler;
    }
}
