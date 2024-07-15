<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $table = 'tb_criteria';
    protected $primaryKey = 'criteria_id';
    public $timestamps = false;

    public function criteria_proportion()
    {
        return $this->belongsTo(Criteria_Proportion::class, 'criteria_id');
    }
}
