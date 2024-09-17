<?php

namespace Lakasir\HasCrudAction\Resolvers;

use Illuminate\Support\Facades\Route;
use InvalidArgumentException;
use Lakasir\HasCrudAction\Interfaces\WithPagination;
use Lakasir\HasCrudAction\Interfaces\WithSimplePagination;
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

        $usingPagintation = false;
        if ($controller instanceof WithPagination) {
            $usingPagintation = true;
        }

        $simplePagination = false;
        if ($controller instanceof WithSimplePagination) {
            $simplePagination = true;
        }

        if (! method_exists($controller, 'response')) {
            if ($simplePagination) {
                return $controller::$model::simplePaginate();
            }

            return $usingPagintation ? $controller::$model::paginate() : $controller::$model::all();
        }

        $record = $usingPagintation ? $controller::$model::paginate() : $controller::$model::all();
        if ($simplePagination) {
            $record = $controller::$model::simplePaginate();
        }

        $response = $this->resolveParameters($controller, 'response', array_merge($availableParams, [
            'record' => $record,
        ]));

        return $response;
    }
}
