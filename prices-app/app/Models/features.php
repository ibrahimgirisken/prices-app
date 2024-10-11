<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class features extends Model
{
    use HasFactory;
    protected $table = "features";

    protected $fillable = ["productId","code","name","department","created_at", "updated_at"];
}
