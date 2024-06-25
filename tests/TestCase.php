<?php

namespace Tests;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
   

    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("delete form address");
        DB::delete("delete form contacts");
        DB::delete("delete form users");

    }
}
