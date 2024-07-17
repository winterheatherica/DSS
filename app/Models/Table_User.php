<?php

namespace App\Models;
use Illuminate\support\Arr;
use Illuminate\Database\Eloquent\Model;

class Table_User extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
}