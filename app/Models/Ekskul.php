<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    use HasFactory;
    protected $table = "ekskul";

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
