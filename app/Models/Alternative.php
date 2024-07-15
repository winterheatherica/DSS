<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    protected $table = 'tb_alternative';
    protected $primaryKey = 'alternative_id';
    public $timestamps = false;

    public function alternative_proportion()
    {
        return $this->belongsTo(Alternative_Proportion::class, 'alternative_id');
    }
}
