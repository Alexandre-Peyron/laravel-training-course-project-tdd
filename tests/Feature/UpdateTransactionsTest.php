<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateTransactionsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function itCanUpdateTransactions()
    {
        $transaction = factory('App\Transaction')->create();
        $newTransaction = factory('App\Transaction')->make();

        $this->put('/transactions/' . $transaction->id, $newTransaction->toArray())
            ->assertRedirect('/transactions');

        $this->get('/transactions')
            ->assertSee($newTransaction->description);
    }

}
