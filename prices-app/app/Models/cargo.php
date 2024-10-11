<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cargo extends Model
{
    use HasFactory;
    protected $table = "cargos";

    protected $fillable = ["minDesi","maxDesi","price","created_at", "updated_at"];
}
