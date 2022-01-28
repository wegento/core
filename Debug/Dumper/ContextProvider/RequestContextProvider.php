<?php

namespace WeGento\Core\Debug\Dumper\ContextProvider;

use Symfony\Component\HttpFoundation\RequestStack;
use WeGento\Core\Debug\Caster\ReflectionCaster;
use WeGento\Core\Debug\Cloner\VarCloner;

final class RequestContextProvider implements ContextProviderInterface
{
    private $requestStack;
    private $cloner;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->cloner = new VarCloner();
        $this->cloner->setMaxItems(0);
        $this->cloner->addCasters(ReflectionCaster::UNSET_CLOSURE_FILE_INFO);
    }

    public function getContext(): ?array
    {
        if (null === $request = $this->requestStack->getCurrentRequest()) {
            return null;
        }

        $controller = $request->attributes->get('_controller');

        return [
            'uri' => $request->getUri(),
            'method' => $request->getMethod(),
            'controller' => $controller ? $this->cloner->cloneVar($controller) : $controller,
            'identifier' => spl_object_hash($request),
        ];
    }
}
