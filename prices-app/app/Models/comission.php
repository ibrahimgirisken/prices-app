<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comission extends Model
{
    use HasFactory;
    protected $table = "comissions";

    protected $fillable = ["platform","product","rate","created_at", "updated_at"];
}
