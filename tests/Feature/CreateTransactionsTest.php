<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTransactionsTest extends TestCase
{
    use RefreshDatabase;

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

    /**
     * @test
     */
    public function itCannotCreateTransactionsWithoutADescription()
    {
        $transaction = factory('App\Transaction')->make(['description' => null]);

        $this->withExceptionHandling()->post('/transactions', $transaction->toArray())
            ->assertSessionHasErrors('description');
    }

    /**
     * @test
     */
    public function itCannotCreateTransactionsWithoutACategory()
    {
        $transaction = factory('App\Transaction')->make(['category_id' => null]);

        $this->withExceptionHandling()->post('/transactions', $transaction->toArray())
            ->assertSessionHasErrors('category_id');
    }

    /**
     * @test
     */
    public function itCannotCreateTransactionsWithoutAnAmount()
    {
        $transaction = factory('App\Transaction')->make(['amount' => null]);

        $this->withExceptionHandling()->post('/transactions', $transaction->toArray())
            ->assertSessionHasErrors('amount');
    }

    /**
     * @test
     */
    public function itCannotCreateTransactionsWithoutAValidAmount()
    {
        $transaction = factory('App\Transaction')->make(['amount' => 'abc']);

        $this->withExceptionHandling()->post('/transactions', $transaction->toArray())
            ->assertSessionHasErrors('amount');
    }
}
