<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewTransactionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function itCanDisplayAllTransactions()
    {
        $transaction = factory('App\Transaction')->create();

        $this->get('/transactions')
            ->assertSee($transaction->description)
            ->assertSee($transaction->category->name);
    }

    /**
     * @test
     */
    public function itCanFilterTransactionsByCategory()
    {
        $category = factory('App\Category')->create();
        $transaction = factory('App\Transaction')->create(['category_id' => $category->id]);
        $otherTransaction = factory('App\Transaction')->create();

        $this->get('/transactions/' . $category->slug)
            ->assertSee($transaction->description)
            ->assertDontSee($otherTransaction->description);
    }
}
