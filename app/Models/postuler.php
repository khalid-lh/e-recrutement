<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postuler extends Model
{
    use HasFactory;
    public function offre()
{
    return $this->belongsTo(Offre::class, 'id_offre');
}

public function user()
{
    return $this->belongsTo(User::class, 'id');
}
}
