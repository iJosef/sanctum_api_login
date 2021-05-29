<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Styde\Enlighten\Tests\EnlightenSetup;

class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use EnlightenSetup;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpEnlighten();
    }
}
