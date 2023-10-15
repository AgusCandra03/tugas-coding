<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.stock', compact('products'));
    }

    public function api()
    {
        $stocks = Stock::with('products')->get();
        $datatables = datatables()->of($stocks)
        ->addColumn('date', function($transaction){
            return format_date($transaction->created_at);
        })
        ->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_product'  => 'required',
            'qty' => 'required',
        ]);

        $stocks = Stock::create($request->all());
        $products = Product::find($request->id_product);
        $products->stock = $products->stock + $request->qty;
        $products->save();
        return redirect('stocks');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
    }
}
