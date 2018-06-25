<?php

namespace Tests;

use Exception;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }

    /**
     *
     */
    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = app()->make(ExceptionHandler::class);
        app()->instance(ExceptionHandler::class, new PassThroughHandler);
    }

    /**
     * @return $this|BaseTestCase
     */
    protected function withExceptionHandling()
    {
        app()->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        return $this;
    }
}

class PassThroughHandler extends Handler
{
    /**
     * PassThroughHandler constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param Exception $e
     */
    public function report(Exception $e)
    {
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Exception                $e
     *
     * @return \Illuminate\Http\Response|void
     * @throws Exception
     */
    public function render($request, Exception $e)
    {
        throw $e;
    }
}