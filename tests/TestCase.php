<?php

namespace Tests;

use Tests\Feature\ExampleTest;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public function test_the_application_returns_a_successful_response()
    {
        $this->get('/')->assertStatus(200);
    }
}
