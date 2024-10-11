<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prices extends Model
{
    use HasFactory;
    protected $table = "prices";

    protected $fillable = ["linkId","productId","code","group_name","title","platform", "seller","price", "price2","cost","ownership", "link","image","created_at", "updated_at"];
}
