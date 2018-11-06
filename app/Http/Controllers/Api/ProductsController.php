<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Product;

class ProductsController extends Controller
{
    private $Product, $totalItems = 10;

    public function __construct(){

        $this->Product = new Product;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $Request)
    {
        
        (array) $datas = $Request->all();

        $products = $this->Product->getResults($datas, $this->totalItems);

        return response()->json($products);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $Request)
    {
        $datas = $Request->all();

        $created = $this->Product->create($datas);

        if($created)
            return response()->json("Cadastrado com sucesso");
        else 
            return response()->json("Not register");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $Request, $id)
    {

        (array) $datas = $Request->all();
        (array) $product = array();
        (array) $edited = array();

        $product = $this->Product->find($id);

        if(isset($product)){

            $edited = $product->update($datas);

            if(!empty($edited))
                return response()->json("Item updated");
            
            return response()->json("Product not updated");

        }else
            return response()->json(["error"=>"Product not founded"], 404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
