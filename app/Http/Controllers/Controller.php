<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="SHD Cloud Integrated Platform API Documentation",
 *      description="Official SHD Cloud Integrated Platform Public API Docs",
 *      @OA\Contact(
 *          email="owenliu0924useful@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Server(
 *     url="https://scip.shdteam.xyz/api"
 * )
 * @OA\Get(
 *     path="/user/count/total",
 *     description="Get total user count.",
 *     @OA\Response(response=200, description="OK")
 * )
 * @OA\Get(
 *     path="/user/count/admin",
 *     description="Get admin user count.",
 *     @OA\Response(response=200, description="OK")
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
