<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SertifikatDetail;

class Sertifikat extends Model
{
    protected $table = 'sertifikat';
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(SertifikatDetail::class, 'sertifikat_id');
    }
}
