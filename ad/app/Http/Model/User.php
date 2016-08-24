<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected  $table='admin';
    protected $primaryKey='uid';
    public $timestamps=false;
}
