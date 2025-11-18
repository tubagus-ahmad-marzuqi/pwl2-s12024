<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'title',
        'product_category_id',
        'id_supplier',
        'description',
        'price',
        'stock',
    ];

    public function get_product(){
        //get all products
        $sql = $this->select("products.*", "category_product.product_category_name as product_category_name", "supplier.supplier_name as supplier_name")
                    ->leftjoin('category_product', 'category_product.id', '=', 'products.product_category_id')
                    ->leftjoin('supplier', 'supplier.id', '=', 'products.id_supplier');  // Join antara tabel suppliers dan products;
        
        return $sql;
    }

    // public function get_category_product(){
    //     $sql = DB::table('category_product')->select('*');

    //     return $sql;
    // }

    // Tambahkan metode untuk menyimpan data
    public static function storeProduct($request, $image)
    {
        // Simpan produk baru menggunakan mass assignment
        return self::create([
            'image'                 => $image->hashName(),
            'title'                 => $request->title,
            'product_category_id'   => $request->product_category_id,
            'id_supplier'           => $request->id_supplier,
            'description'           => $request->description,
            'price'                 => $request->price,
            'stock'                 => $request->stock
        ]);
    }

    // Tambahkan metode untuk edit data
    public static function updateProduct($id, $request, $image = null)
    { 
        $product = self::find($id);

        if ($product) {
            $data = [
                'title'                 => $request['title'],
                'product_category_id'   => $request['product_category_id'],
                'id_supplier'           => $request['id_supplier'],
                'description'           => $request['description'],
                'price'                 => $request['price'],
                'stock'                 => $request['stock']
            ];

            if (!empty($image)) {
                $data['image'] = $image;
            }

            $product->update($data);
            return $product;

        }else{
            return "tidak ada data yang diupdate";
        } 
    }
}