<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Loans;

class LoansController extends Controller
{
    public function index()
    {
        return Loans::all();
    }

    public function show($id)
    {
        return Loans::find($id);
    }

    public function store(Request $request)
    {
    	$loan = Loans::create($request->all());

        return response()->json($loan, 201);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());

        return response()->json($loan, 200);
    }

    public function delete(Loans $loan)
    {
        $loan->delete();

        return response()->json(null, 204);
    }
}
