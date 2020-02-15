<?php
/**
 * Created by PhpStorm.
 * User: suspensk
 * Date: 15.02.2020
 * Time: 19:48
 */
namespace App\Exceptions;

use Exception;

class UserHasNoPermissions extends Exception
{
    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
     //   \Log::debug('User not found');
    }

    public function render($request)
    {
        return response()->view('errors.no-permissions', [], 404);
    }
}