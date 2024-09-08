<?php

namespace Lakasir\HasCrudAction\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lakasir\HasCrudAction\Skeleton\SkeletonClass
 */
class HasCrudAction extends Facade
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
