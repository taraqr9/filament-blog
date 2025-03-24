<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $guarded = [];

    public static function store(Exception $error)
    {

        dd($error);
        ErrorLog::create([
            'message' => $error->getMessage(),
        ]);
    }
}
