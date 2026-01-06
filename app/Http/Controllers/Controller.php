<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(title="My First API", version="0.1")
 */
abstract class Controller
{
    /**
     * @OA\Info(
     *    title="Swagger with Laravel",
     *    version="1.0.0",
     * )
     * @OA\SecurityScheme(
     *     type="http",
     *     securityScheme="bearerAuth",
     *     scheme="bearer",
     *     bearerFormat="JWT"
     * )

     */
    /**
     * Execute an action on the controller.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        return $this->{$method}(...array_values($parameters));
    }
}
