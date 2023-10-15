<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
        $users = User::all();
        return view('admin.transaction', compact('products', 'users'));
    }

    public function api() 
    {
        $transactions = Transaction::with('products', 'users')->get();
        $datatables = datatables()->of($transactions)
        ->addColumn('date', function($transaction){
            return format_date($transaction->created_at);
        })
        ->addColumn('rupiah', function($transaction){
            return rupiah($transaction->total);
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

        $transactions = new Transaction;
        $transactions->id_product = $request->id_product;
        $transactions->id_user = Auth()->user()->id;
        $transactions->qty = $request->qty;
        $transactions->total = $request->qty * $transactions->products->price;
        $transactions->save();
        $products = Product::find($request->id_product);
        $products->stock = $products->stock - $request->qty;
        $products->save();

        return redirect('transactions');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
