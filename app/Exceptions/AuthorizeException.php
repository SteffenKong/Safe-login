<?php

namespace App\Exceptions;

use Exception;

class AuthorizeException extends \Exception
{
    public function handle($request,Exception $exception) {
        return jsonPrint('001',$exception->getMessage());
    }
}
