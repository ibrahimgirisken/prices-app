<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class earning_raties extends Model
{
    use HasFactory;
    protected $table="earning_raties";
    protected $fillable=["department_id","rate"];

    public function department()
{
    return $this->belongsTo(department::class, 'department_id', 'id');
}
}
