<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers
 * @OA\Info (
 *     title = "Api",
 *     version = "1.0.0"
 * )
 *
 * @OA\Server (
 *     description = "Laravel Swagger API server",
 *     url = "http://127.0.0.1:8000/api"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer"
 * )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
