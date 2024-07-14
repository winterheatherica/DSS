<?php

namespace App\Models;
use Illuminate\support\Arr;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $table = 'tb_criteria';
    protected $primaryKey = 'criteria_id';
    public $timestamps = false;
}
