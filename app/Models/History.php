<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'tb_history';
    protected $primaryKey = 'history_id';
    public $timestamps = false;

    public function method()
    {
        return $this->belongsTo(DSS_Method::class, 'method_id');
    }

    public function alternative_proportions()
    {
        return $this->hasMany(Alternative_Proportion::class, 'history_id');
    }

    public function criteria_proportions()
    {
        return $this->hasMany(Criteria_Proportion::class, 'history_id');
    }
}
