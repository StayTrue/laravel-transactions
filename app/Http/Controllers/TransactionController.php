<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionRequest;
use App\Http\Requests\GetAllTransactionsRequest;
use App\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Index transactions
     *
     * @param GetAllTransactionsRequest $request Request
     * @param int|null                  $id      Id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(GetAllTransactionsRequest $request, $id = null)
    {
        $transactionsQuery = Transaction::all();

        if ($id) {
            $transactionsQuery = Transaction::where(['user_id' => $id]);
        }

        if ($id === null) {
            $transactionsQuery = Transaction::select(
                DB::raw(
                    "DATE_FORMAT(date, '%Y-%m-%d 00:00:00') as date, 
                1 as total_amount"
                ))
                ->groupBy(['date']);
        }

        if ($request->has('orderBy'))
        {
            $transactionsQuery = $transactionsQuery->orderBy(
                $request->input('orderBy'), ($request->has('sortOrder')
                    ? $request->input('sortOrder')
                    : 'asc')
            );
        }

        $transactions = $transactionsQuery->paginate(10);
        return response()->json($transactions, 200);
    }

    /**
     * Create new transaction
     *
     * @param CreateTransactionRequest $request Request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateTransactionRequest $request)
    {
        $transaction = Transaction::create($request->validated());

        return response()->json(
            ['id' => $transaction->id],
            201
        );
    }

}
