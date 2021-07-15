<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Loans;

class LoansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->id;
            dd($this->id);

            return $next($request);
        });
    }

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
        $data = $request->all();

        $validator = Validator::make($data, [
            'user_id' => 'required',
            'amount_required' => 'required',
            'loan_term' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        
    	$loan = Loans::create($data);

        return response()->json($loan, 201);
    }

    public function repay(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'user_id' => 'required',
            'amount_required' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $loan = DB::table('loans')->where('user_id', $data['user_id'])->first();
        $amount_left = $loan->amount_required - $data['amount_required']
        $loan->update(['amount_required' => $amount_left]);

        return response()->json($loan, 200);
    }

    public function delete(Loans $loan)
    {
        if ($loan->delete()) {
            return response()->json(['message' => 'Record deleted successfully!'], 204);
        }
        return response()->json(['errors' => 'Something went Wrong! Record could not be deleted']);
    }
}
