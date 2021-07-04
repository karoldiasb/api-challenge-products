<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Interfaces\ProductInterface;
use App\Models\Product;
use DB;

class ProductRepository implements ProductInterface
{
    public function getAllProducts()
    {
        try {
            $products = Product::all();
            return $products;
        } catch(\Exception $e) {
            return response('Products not found.', 404);
        }
    }

    public function saveProduct(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            // $contents = file_get_contents(storage_path('app/products.json')); //teste

            $contents = file_get_contents($request->file->path());
        
            $arquivos = json_decode($contents);

            foreach ($arquivos as $arquivo){
                $product = new Product();
                $product->title = $arquivo->title;
                $product->type = $arquivo->type;
                $product->description = $arquivo->description;
                $product->filename = $arquivo->filename;
                $product->height = $arquivo->height;
                $product->width = $arquivo->width;
                $product->price = $arquivo->price;
                $product->rating = $arquivo->rating;
                
                $product->save();
            }

            DB::commit();

            return response('Products saved.', 201);

        } catch(\Exception $e) {
            DB::rollBack();
            // return response('Cannot save.', 404);
        }
    }

    public function getProductById($id)
    {
        try {
            $product = Product::find($id);
            return $product;
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function editProduct($id, $params)
    {
        DB::beginTransaction();
        try {
            $product = Product::find($id);

            // Check the product
            if(!$product) 
                return response('Not found product.', 404);

            // Update the product
            $product->title = $params->title;
            $product->type = $params->type;
            $product->price = $params->price;
            $product->rating = $params->rating;

            $product->save();

            DB::commit();

            return response('Product edited.', 200);
            
        } catch(\Exception $e) {
            DB::rollBack();
        }
    }

    public function deleteProduct($id)
    {
        DB::beginTransaction();
        try {
            $product = Product::find($id);

            // Check the product
            if(!$product) 
                return response('Not found product.', 404);

            // Delete the product
            $product->delete();

            DB::commit();
            return response('Product deleted.', 200);
            
        } catch(\Exception $e) {
            DB::rollBack();
        }
    }
}