<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewTransactionsTest extends TestCase
{
    /**
     * @test
     */
    public function itCanDisplayAllTransactions()
    {
        $transaction = factory('App\Transaction')->create();

        $this->get('/transactions')
            ->assertSee($transaction->description);
    }
}
