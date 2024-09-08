<?php

namespace Lakasir\HasCrudAction\Resolvers;

use Illuminate\Support\Facades\Route;
use InvalidArgumentException;
use ReflectionException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;

class IndexActionResolver extends BaseActionResolver
{
    /**
     * @param  class-string  $controller
     * @return array
     *
     * @throws InvalidArgumentException
     * @throws BadRequestException
     * @throws SuspiciousOperationException
     * @throws ReflectionException
     */
    public function resolve($controller)
    {
        $availableParams = array_merge($this->availableKeyParams(), [
            'method' => Route::getCurrentRequest()->method(),
            'model' => new $controller::$model(),
            'action' => 'index',
            'route' => Route::getCurrentRoute()->getName(),
        ]);

        if (! method_exists($controller, 'response')) {
            return $controller::$model::all();
        }

        $response = $this->resolveParameters($controller, 'response', array_merge($availableParams, [
            'record' => $controller::$model::all(),
        ]));

        return $response;
    }
}
