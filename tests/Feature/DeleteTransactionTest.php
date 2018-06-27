<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTransactionTest extends TestCase
{
    /**
     * @test
     */
    public function itCanDeleteTransaction()
    {
        $transaction = factory('App\Transaction')->create();

        $this->delete('/transactions/'. $transaction->id)
            ->assertRedirect('/transactions');

        $this->get('/transactions')
            ->assertDontSee($transaction->description);
    }
}
