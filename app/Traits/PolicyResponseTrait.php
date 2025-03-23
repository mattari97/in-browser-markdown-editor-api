<?php

namespace App\Traits;

use Illuminate\Auth\Access\Response;

trait PolicyResponseTrait {

    /**
     * Returns a HTTP Response
     *
     * @param bool $condition
     * @param string $errorMessage
     * @param int $statusCode
     * @return void
     */
    protected function applyPolicy(bool $condition, string $errorMessage, int $statusCode = 403): Response
    {
        return $condition
            ? Response::allow()
            : Response::deny($errorMessage, $statusCode);
    }
}
