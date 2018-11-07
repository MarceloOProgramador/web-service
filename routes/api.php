<?php

/**
$this->get("categories", "Api\CategoryController@index");
$this->post("categories", "Api\CategoryController@store");
$this->put("categories/{id}", "Api\CategoryController@update");
$this->delete("categories/{id}", "Api\CategoryController@destroy");
*/

$this->group(["prefix" => "v1", "namespace" => 'Api\v1'], function(){

    $this->get("/category/{id}/products", "CategoryController@getProducts");

    $this->apiResource("categories", "CategoryController");

    $this->apiResource("products", "ProductsController");

});