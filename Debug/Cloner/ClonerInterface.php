<?php
namespace WeGento\Core\Debug\Cloner;


interface ClonerInterface
{
    /**
     * Clones a PHP variable.
     *
     * @param mixed $var Any PHP variable
     *
     * @return Data The cloned variable represented by a Data object
     */
    public function cloneVar($var);
}
