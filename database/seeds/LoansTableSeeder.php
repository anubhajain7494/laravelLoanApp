<?php

use Illuminate\Database\Seeder;
use App\Loans;

class LoansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Loans::truncate();
        $loans = [[
            'user_id' => 1,
            'amount_required' => 10000,
            'loan_term' => 2
        ], [
            'user_id' => 1,
            'amount_required' => 550000,
            'loan_term' => 5
        ], [
            'user_id' => 1,
            'amount_required' => 145000,
            'loan_term' => 1
        ]];
        foreach($loans as $loan){
            Loans::create($loan);
        }
    }
}
