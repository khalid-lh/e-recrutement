<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class offre extends Model
{
    use HasFactory;
    protected $table = 'offres';
    protected $primaryKey = 'id_offre';

    use SoftDeletes;
    public function company()
    {
        return $this->belongsTo(company::class, 'company_id');
    }
    public function postulers()
{
    return $this->hasMany(Postuler::class, 'id_offre');
}
public function enregistrements()
{
    return $this->hasMany(enregister::class, 'id_offre');
}
public function user()
    {
        return $this->belongsTo(User::class, 'id_recruteur');
    }
    public function categorie()
    {
        return $this->belongsTo(categories::class, 'id_categorie');
    }
}
