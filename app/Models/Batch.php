<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'batch';
    protected $guarded = ['id'];

    public function sertifikat()
    {
        return $this->belongsTo(Sertifikat::class, 'sertifikat_id');
    }
}
