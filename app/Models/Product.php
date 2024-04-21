<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ["prodID", "prodName", "prodImage", "prodPrice", "prodDesc", "prodCategory"];
    protected $primaryKey = "prodID";
    
    protected $appends = ['full_path_url'];
}
