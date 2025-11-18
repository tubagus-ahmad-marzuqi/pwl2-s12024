<?php

namespace App\Http\Controllers;

//import model supplier
use App\Models\Supplier;

//import return type View
use Illuminate\View\View;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        // get all supplier
        // $supplier = Supplier::latest()->paginate(10);

        $suppliers = new Supplier;
        $supplier = $suppliers->get_supplier()
                            ->latest()
                            ->paginate(10);
                            
        //render view with supplier
        return view('supplier.index', compact('supplier'));
    }
}
