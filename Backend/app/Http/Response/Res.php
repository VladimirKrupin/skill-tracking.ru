<?php
namespace App\Http\Response;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Http\JsonResponse;

class Res extends Response
{
    public function __construct($content = '', $status = 200, array $headers = [])
    {
        parent::__construct($content, $status, $headers);
    }
}