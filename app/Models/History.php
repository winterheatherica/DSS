<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'tb_history';
    protected $primaryKey = 'history_id';

    public function method()
    {
        return $this->belongsTo(DSS_Method::class, 'method_id');
    }
}