<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTransactionsTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateTransactions()
    {
        $transaction = factory('App\Transaction')->make();

        $this->post('/transactions', $transaction->toArray())
            ->assertRedirect('/transactions');

        $this->get('/transactions')
            ->assertSee($transaction->description);
    }
}
