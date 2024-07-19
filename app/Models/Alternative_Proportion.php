<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternative_Proportion extends Model
{
    protected $table = 'tb_alternative_proportion';
    public $timestamps = false;

    public function alternative()
    {
        return $this->belongsTo(Alternative::class, 'alternative_id', 'alternative_id');
    }
}

