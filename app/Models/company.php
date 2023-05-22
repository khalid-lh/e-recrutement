<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $primaryKey = 'company_id'; 

    public function offers()
{
    return $this->hasMany(Offre::class, 'company_id');
}
protected $fillable = ['photo'];

}
