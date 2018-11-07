<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = ["name", "description", "image", "category_id"];

    /**
     * Method responsible for return the products
     * @param array $datas
     * @param int $total
     * @return array $products
     */

    public function getResults(array $datas, int $total){

        if(!isset($datas["filter"]) && !isset($datas["name"]) && !isset($datas["description"]))
            return $this->paginate($total);

        return $this->where(function($query) use ($datas){

            if(isset($datas["filter"])){

                $filter = $datas["filter"];

                $query->where("name", $datas["filter"]);
                $query->orWhere("description", "LIKE", "%{$filter}%");

            }

            if(isset($datas["name"]))
                $query->where("name", $datas["name"]);

            if(isset($datas["description"]))
                $query->where("description", "LIKE", "%{$datas['description']}%");

        })->paginate($total);
        
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
