<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    protected $fillable = ["name"];

    public function getCategories(string $filter){

        return $this->where("name", "LIKE", "%{$filter}%")->get();

    }

    public function getProducts(){
        return $this->hasMany(Product::class);
    }
}
