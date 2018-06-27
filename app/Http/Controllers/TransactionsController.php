<?php

namespace App\Http\Controllers;

use App\Category;
use App\Transaction;
use Illuminate\Http\Request;

/**
 * Class TransactionsController
 *
 * @package App\Http\Controllers
 */
class TransactionsController extends Controller
{
    /**
     * @param Category $category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Category $category)
    {
        $transactions = Transaction::byCategory($category)->get();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();

        return view('transactions.create', compact('categories'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $this->validate(request(), [
           'description' => 'required',
           'category_id' => 'required',
           'amount'      => 'required|numeric'
        ]);

        Transaction::create(request()->all());

        return redirect('/transactions');
    }

    /**
     * @param Transaction $transaction
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Transaction $transaction)
    {
        $categories = Category::all();

        return view('transactions.update', compact('categories', 'transaction'));
    }

    /**
     * @param Transaction $transaction
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Transaction $transaction)
    {
        $this->validate(request(), [
            'description' => 'required',
            'category_id' => 'required',
            'amount'      => 'required|numeric'
        ]);

        $transaction->update(request()->all());

        return redirect('/transactions');
    }

    /**
     * @param Transaction $transaction
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect('/transactions');
    }
}
