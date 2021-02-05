<?php
/**
 * @OA\Schema(
 *      title="Request",
 *      description="Store Project request body data",
 *      type="object"
 * )
 */

class Request
{
    /**
     * @OA\Property(
     *      title="phone",
     *      description="Name of the new project",
     *      example="380123456789"
     * )
     *
     * @var string
     */
    public $phone;

    /**
     * @OA\Property(
     *      title="password",
     *      description="Description of the new project",
     *      example="password"
     * )
     *
     * @var string
     */
    public $password;


}
