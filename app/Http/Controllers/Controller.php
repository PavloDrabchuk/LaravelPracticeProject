<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers
 *
 * @OA\Info (
 *     title = "Api",
 *     version = "1.0.0",
 *     @OA\Contact(
 *         email="ravluk2000@gmail.com"
 *      ),
 *     @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Tag (
 *     name = "Authorization"
 * )
 *
 * @OA\Tag (
 *     name = "Category"
 * )
 *
 * @OA\Tag (
 *     name = "Product"
 * )
 *
 * @OA\Tag (
 *     name = "Cart"
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
