<?php

namespace test\eLife\Hypothesis;

use Silex\Application;

trait SilexTestCase
{
    private $app;

    /**
     * @before
     */
    final public function setUpApp()
    {
        $this->app = require __DIR__.'/../src/bootstrap.php';
    }

    final protected function getApp() : Application
    {
        return $this->app;
    }
}
