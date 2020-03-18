<?php

namespace Chocofamilyme\LaravelHealthCheck\Controllers;

use Illuminate\Routing\Controller;
use Chocofamilyme\LaravelHealthCheck\Services\ComponentCheckService;

class HealthCheckController extends Controller
{
    /**
     * @var ComponentCheckService
     */
    private $componentCheck;

    /**
     * HealthCheckController constructor.
     */
    public function __construct()
    {
        $this->componentCheck = new ComponentCheckService();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function simple()
    {
        $checks = $this->componentCheck->getResponse();
        $responseClass = config('healthcheck.response');
        return (new $responseClass)->simpleResponse($checks);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function extendet()
    {
        if(!config('healthcheck.extendet')) {
            return null;
        }

        $checks = $this->componentCheck->getResponse();
        $responseClass = config('healthcheck.response');
        return (new $responseClass)->extendetResponse($checks);
    }
}
