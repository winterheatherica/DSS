<?php

namespace App\Models;
use Illuminate\support\Arr;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    protected $table = 'tb_alternative';
    protected $primaryKey = 'alternative_id';
    public $timestamps = false;
}