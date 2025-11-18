<?php

namespace App\Http\Controllers;

//import model
use App\Models\transaksi_penjualan;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

//import return type View
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

//import return untuk send email
use Illuminate\Support\Facades\Mail;

class transaksi_penjualanController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
       
        $transaksi_penjualan = new transaksi_penjualan;
        $data = $transaksi_penjualan->get_transaksi_penjualan()->latest()->paginate(10);
             
        // foreach ($data as $key => $value) {
        //     $data[$key]['total_harga_'] = $value['jumlah_pembelian'] * $value['price'];
        // } 
        
        //render view with transaksi_penjualan
        return view('transaksi_penjualan.index', compact('data'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        $product = new Product;

        $data['products'] = $product->get_product()->get();

        return view('transaksi_penjualan.create', compact('data'));
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get product by ID
        $transaksi_penjualan = new transaksi_penjualan;
        $data = $transaksi_penjualan->get_transaksi_penjualan_detail()->where("transaksi_penjualan.id", $id)->get();

        $total_harga['transaksi'] = 0;
        foreach ($data as $key => $value) {
            $total_harga['transaksi'] = $total_harga['transaksi'] + $value['total_harga'];
        }

        //render view with product
        return view('transaksi_penjualan.show', compact('data','total_harga'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        
        $validatedData = $request->validate([
            'nama_kasir'            => 'required|min:4',
            'email_pembeli'         => 'required|min:5',
            'id_product.*'          => 'required|integer',
            'jumlah_pembelian.*'    => 'required|integer'
        ]);

        
        $transaction = new transaksi_penjualan();
         
        $transaction->nama_kasir = $validatedData['nama_kasir'];
        $transaction->email_pembeli = $validatedData['email_pembeli'];
        $transaction->tanggal_transaksi = now();
        $transaction->created_at = now();
        $transaction->updated_at = now();

        $transaction->save();

        if ($transaction) {         
            foreach ($validatedData['id_product'] as $key => $value) {
                DB::table('transaksi_penjualan_detail')->insert([
                    'id_transaksi' => $transaction->id,
                    'id_product' => $value,
                    'jumlah_pembelian' => $validatedData['jumlah_pembelian'][$key]
                ]);
            }

            $this->sendEmail($validatedData['email_pembeli'], $transaction->id);

            return redirect()->route('transaksi_penjualan.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect to index
            return redirect()->route('transaksi_penjualan.index')->with(['error' => 'Gagal Insert Data']);
        }
    }

    public function sendEmail($to, $id)
    {
        //get transaksi by ID
        $transaksi_penjualan = new transaksi_penjualan;
        $data = $transaksi_penjualan->get_transaksi_penjualan_detail()->where("transaksi_penjualan.id", $id)->get();

        $total_harga['transaksi'] = 0;
        foreach ($data as $key => $value) {
            $total_harga['transaksi'] = $total_harga['transaksi'] + $value['total_harga'];
        }

        $transaksi_ = [
            'data' => $data,
            'total_harga' => $total_harga
        ];

        // Mengirim email
        Mail::send('transaksi_penjualan.trans_mail', $transaksi_, function ($message) use ($to, $data, $total_harga) {
            $message->to($to)
                    ->subject("Transaksi Details: {$data[0]['email_pembeli']} - dengan Total tagihan RP ".number_format($total_harga['transaksi'], 2, ',', '.').".");
        });

        return response()->json(['message' => 'Email sent successfully!']);
    }
}
