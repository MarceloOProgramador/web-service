<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateCategoryRequest;
use App\Http\Controllers\Controller;
Use App\Models\Category;

class CategoryController extends Controller
{

    private $Category, $totalItems = 10;
    
    public function __construct() {

        $this->Category = new Category();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $Request)
    {
        $categories = $this->Category->getCategories($Request->name);

        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $Request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategoryRequest $Request)
    {

        $datas = $Request->all();

        $stored = $this->Category->create($datas);

        if($stored)
            return response()->json($stored, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->Category->find($id);

        if($category)
            return response()->json($category, 202);
        else
            return response()->json(["error" => "Not Found"], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCategoryRequest $request, $id)
    {
        (array) $datas = []; 
        (array) $category = [];

        $datas = $request->all();

        $category = $this->Category->find($id);

        if($category){

            $category->update($datas);
            return response()->json($category);

        } else 
            return response()->json(["error" => "Not found"], 404);
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $category = $this->Category->find($id);

        if($category){

            $category->delete();
            return response()->json(["success" => "Deleted"], 204);

        } else 
            return response()->json(["error" => "Not found"], 404);
        
    }

    public function getProducts($id){
        (array) $category = array();
        (array) $products = array();
        
        $category = $this->Category->find($id);

        if(isset($category)){
            $products = $category->getProducts()->paginate($this->totalItems);
            return response()->json(["products" => $products, "category" => $category]);
        } else 
            return response()->json(["errors" => "Category not founded"], 404);

    }
}
