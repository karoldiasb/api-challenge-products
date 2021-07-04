<?php

namespace App\Interfaces;

use App\Http\Requests\ProductRequest;

interface ProductInterface
{
    /**
     * Get all products
     * 
     * @method  GET api/products
     * @access  public
     */
    public function getAllProducts();

    /**
     * Create Product
     * 
     * @param   \App\Http\Requests\ProductRequest    $request
     * 
     * @method  POST    api/products       For Create
     * @access  public
     */
    public function saveProduct(ProductRequest $request);

     /**
     * Update Product
     * 
     * @param   \App\Http\Requests\ProductRequest    $request
     * 
     * @method  PUT     api/products/{id}  For Update     
     * @access  public
     */
    public function editProduct(Int $id, ProductRequest $request);

     /**
     * Get Product By ID
     * 
     * @param   integer     $id
     * 
     * @method  GET api/products/{id}
     * @access  public
     */
    public function getProductById($id);

    /**
     * Delete Product
     * 
     * @param   integer     $id
     * 
     * @method  DELETE  api/products/{id}
     * @access  public
     */
    public function deleteProduct($id);
}