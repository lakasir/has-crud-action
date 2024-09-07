<?php

namespace Lakasir\HasCrudAction;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lakasir\HasCrudAction\Skeleton\SkeletonClass
 */
class HasCrudActionFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'has-crud-action';
    }
}
