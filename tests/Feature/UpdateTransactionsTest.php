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

    /**
     * @test
     */
    public function itCannotUpdateTransactionsWithoutADescription()
    {
        $transaction = factory('App\Transaction')->create();
        $newTransaction = factory('App\Transaction')->make(['description' => null]);

        $this->withExceptionHandling()->put('/transactions/' . $transaction->id, $newTransaction->toArray())
            ->assertSessionHasErrors('description');
    }

    /**
     * @test
     */
    public function itCannotUpdateTransactionsWithoutACategory()
    {
        $transaction = factory('App\Transaction')->create();
        $newTransaction = factory('App\Transaction')->make(['category_id' => null]);

        $this->withExceptionHandling()->put('/transactions/' . $transaction->id, $newTransaction->toArray())
            ->assertSessionHasErrors('category_id');
    }

    /**
     * @test
     */
    public function itCannotUpdateTransactionsWithoutAnAmount()
    {
        $transaction = factory('App\Transaction')->create();
        $newTransaction = factory('App\Transaction')->make(['amount' => null]);

        $this->withExceptionHandling()->put('/transactions/' . $transaction->id, $newTransaction->toArray())
            ->assertSessionHasErrors('amount');
    }

    /**
     * @test
     */
    public function itCannotUpdateTransactionsWithoutAValidAmount()
    {
        $transaction = factory('App\Transaction')->create();
        $newTransaction = factory('App\Transaction')->make(['amount' => 'abc']);

        $this->withExceptionHandling()->put('/transactions/' . $transaction->id, $newTransaction->toArray())
            ->assertSessionHasErrors('amount');
    }
}
