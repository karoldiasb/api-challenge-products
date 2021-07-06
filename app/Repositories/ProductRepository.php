<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Interfaces\ProductInterface;
use App\Traits\ResponseAPI;
use App\Models\Product;
use DB;

class ProductRepository implements ProductInterface
{
    use ResponseAPI;

    public function getAllProducts()
    {
        try {
            $products = Product::all();
            return $this->success("Todos os produtos", $products);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function saveProduct(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            
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

            return $this->success("Produtos salvos com sucesso!", 200);

        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getProductById($id)
    {
        try {
            $product = Product::find($id);
            return $this->success("Produto {$id}", $product);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function editProduct($id, $params)
    {
        DB::beginTransaction();
        try {
            $product = Product::find($id);

            if(!$product) 
                return response('Not found product.', 404);

            $product->title = $params->title;
            $product->type = $params->type;
            $product->price = $params->price;
            $product->rating = $params->rating;

            $product->save();

            DB::commit();

            return $this->success("Produto {$product->title} editado com sucesso!", $product);
            
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function deleteProduct($id)
    {
        DB::beginTransaction();
        try {
            $product = Product::find($id);

            if(!$product) 
                return $this->error('Produto não encontrado', 404);

            $product->delete();

            DB::commit();
            return $this->success("Produto {$product->title} deletado", $product);
            
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}