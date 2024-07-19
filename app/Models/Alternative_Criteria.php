<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternative_Criteria extends Model
{
    protected $table = 'tb_alternative_criteria';
    public $timestamps = false;

    public function alternative()
    {
        return $this->belongsTo(Alternative::class, 'alternative_id', 'alternative_id');
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id', 'criteria_id');
    }
}
