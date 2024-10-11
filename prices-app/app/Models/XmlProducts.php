<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XmlProducts extends Model
{
    use HasFactory;
    protected $table = "xml_products";

    protected $fillable = ["code","productCode","brand","desi","stock","price"];
}
