<?php

namespace Lakasir\HasCrudAction\Abstracts;

use Illuminate\Http\Request;
use Lakasir\HasCrudAction\Resolvers\DestroyActionResolver;
use Lakasir\HasCrudAction\Resolvers\IndexActionResolver;
use Lakasir\HasCrudAction\Resolvers\ShowActionResolver;
use Lakasir\HasCrudAction\Resolvers\StoreActionResolver;
use Lakasir\HasCrudAction\Resolvers\UpdateActionResolver;

abstract class HasCrudActionAbstract
{
    public function index(IndexActionResolver $resolver)
    {
        return $resolver->resolve(new static);
    }

    public function show(ShowActionResolver $resolver, $id)
    {
        return $resolver->resolve(new static, $id);
    }

    public function store(StoreActionResolver $resolver, Request $request)
    {
        return $resolver->resolve(new static, $request->all());
    }

    public function update(UpdateActionResolver $resolver, Request $request, $id)
    {
        return $resolver->resolve(new static, $request->all(), $id);
    }

    public function destroy(DestroyActionResolver $resolver, $id)
    {
        return $resolver->resolve(new static, $id);
    }
}
