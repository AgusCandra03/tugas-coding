<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_user = User::count();
        $total_category = Category::count();
        $total_product = Product::count();
        $total_transaction = Transaction::count();

        $data_pie = Transaction::select(DB::raw("qty"))->pluck('qty');
        $label_pie = Product::orderBy('id', 'asc')->groupBy('name')->pluck('name');

        $label_bar = ['Transaksi Product'];
        $data_bar = [];

        foreach ($label_bar as $key =>$value){

        }

        return view('home', compact('total_user', 'total_category', 'total_product', 'total_transaction', 'data_pie', 'label_pie'));
    }
}
