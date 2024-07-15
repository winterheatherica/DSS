<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria_Proportion extends Model
{
    protected $table = 'tb_criteria_proportion';
    public $timestamps = false;

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id', 'criteria_id');
    }
}
