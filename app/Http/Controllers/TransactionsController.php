<?php

namespace App\Http\Controllers;

use App\Category;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index(Category $category = null)
    {
        if ($category && $category->exists) {
            $transactions = $transactions = Transaction::latest()->where('category_id', $category->id)->get();
        }
        else {
            $transactions = Transaction::latest()->get();
        }

        return view('transactions.index', compact('transactions'));
    }
}
