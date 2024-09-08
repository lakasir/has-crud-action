<?php

namespace Lakasir\HasCrudAction\Resolvers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Lakasir\HasCrudAction\Resolvers\BaseActionResolver;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;

class StoreActionResolver extends BaseActionResolver
{
    /**
     * @param  class-string  $controller
     * @param  mixed  $data
     * @return mixed
     *
     * @throws InvalidArgumentException
     * @throws BadRequestException
     * @throws SuspiciousOperationException
     * @throws ValidationException
     */
    public function resolve($controller, $data)
    {
        $availableParams = array_merge($this->availableKeyParams(), [
            'method' => Route::getCurrentRequest()->method(),
            'model' => new $controller::$model(),
            'action' => 'store',
            'route' => Route::getCurrentRoute()->getName(),
        ]);

        if (method_exists($controller, 'rules')) {
            $rules = $this->resolveParameters($controller, 'rules', $availableParams);

            Validator::make($data, $rules)->validate();
        }

        $model = new $controller::$model();
        $model->fill($data);
        if (method_exists($controller, 'beforeStore')) {
            $model = $this->resolveParameters($controller, 'beforeStore', array_merge($availableParams, [
                'model' => $model,
                'data' => $data,
            ]));
        }
        $model->save();

        if (! method_exists($controller, 'response')) {
            return $model;
        }

        $response = $this->resolveParameters($controller, 'response', array_merge($availableParams, [
            'model' => $model,
            'data' => $data,
            'record' => $model,
        ]));

        return $response;
    }
}
