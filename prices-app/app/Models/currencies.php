<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class currencies extends Model
{
    use HasFactory;
    protected $table = "currencies";

    protected $fillable = ["id","currencyData","gainRate","created_at", "updated_at"];
}
