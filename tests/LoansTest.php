<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class LoansTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testsLoansAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'user_id' => 1,
            'amount_required' => 10000,
            'loan_term' => 2
        ];

        $this->json('POST', '/api/loans', $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'amount_required' => 10000, 'loan_term' => 2]);
    }

    public function testsLoansAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $loan = factory(Loans::class)->create([
            'user_id' => 1,
            'amount_required' => 10000,
            'loan_term' => 2
        ]);

        $payload = [
            'user_id' => 1,
            'amount_required' => 20000,
            'loan_term' => 2
        ];

        $response = $this->json('PUT', '/api/loans/' . $loan->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([ 
                'id' => 1, 
                'amount_required' => 20000,
            	'loan_term' => 2 
            ]);
    }

    public function testsLoansAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $loan = factory(Loans::class)->create([
            'user_id' => 1,
            'amount_required' => 1500000,
            'loan_term' => 5
        ]);

        $this->json('DELETE', '/api/loans/' . $loan->id, [], $headers)
            ->assertStatus(204);
    }

    public function testLoansAreListedCorrectly()
    {
        factory(Loans::class)->create([
            'user_id' => 1,
            'amount_required' => 5000,
            'loan_term' => 1
        ]);

        factory(Loans::class)->create([
            'user_id' => 1,
            'amount_required' => 45000,
            'loan_term' => 2
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/loans', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [ 'amount_required' => 5000, 'loan_term' => 1 ],
                [ 'amount_required' => 45000, 'loan_term' => 2 ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'user_id', 'amount_required', 'loan_term', 'created_at', 'updated_at'],
            ]);
    }
}
