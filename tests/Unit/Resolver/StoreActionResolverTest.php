<?php

namespace Lakasir\HasCrudAction\Tests\Unit\Resolvers;

use Lakasir\HasCrudAction\Tests\TestCase;
use Mockery as m;

class StoreActionResolverTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        m::close();
    }

    public function test_store_method_with_rules_validation()
    {
    }

    public function test_store_method_with_beforeStore_method()
    {
    }

    public function test_should_return_record_if_response_method_is_not_defined()
    {
    }

    public function test_should_call_response_method_and_return_its_result()
    {
    }
}
