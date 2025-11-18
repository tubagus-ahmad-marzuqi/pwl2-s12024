<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class transaksi_penjualan extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */

    protected $table = 'transaksi_penjualan';

    public function get_transaksi_penjualan(){
        //get all transaksi_penjualan
        $sql = $this->select("*");

        return $sql;
    }

    public function get_transaksi_penjualan_detail(){
        //get all transaksi_penjualan
        $sql = $this->select("transaksi_penjualan.*", "transaksi_penjualan_detail.*","products.title", "products.price",
                             "category_product.product_category_name as product_category_name", 
                              DB::raw("(jumlah_pembelian*price) as total_harga")) 
                            ->join("transaksi_penjualan_detail", "transaksi_penjualan_detail.id_transaksi", "=", "transaksi_penjualan.id")
                            ->join("products", "transaksi_penjualan_detail.id_product", "=", "products.id")
                            ->join('category_product', 'category_product.id', '=', 'products.product_category_id');
        return $sql;
    }
}
