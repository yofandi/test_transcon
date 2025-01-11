<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Transactiondetail;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('transactionDetails')
            ->get()
            ->map(function ($transaction) {
                $transaction->total_item = $transaction->totalItem;
                $transaction->total_quantity = $transaction->totalQuantity;
                return $transaction;
            });
        return view('index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->only(['transaction_no', 'transaction_date', 'item', 'quantity']);
        $transactionProgress = Transaction::create([
            'no_transaction' => $input['transaction_no'],
            'transaction_date' => $input['transaction_date'],
        ]);

        $idtransactionProgress = $transactionProgress->id;

        $transactionDetails = [];

        for ($i = 0; $i < count($input['item']); $i++) {
            $transactionDetails[] = [
                'transaction_id' => $idtransactionProgress,
                'item' => $input['item'][$i],
                'quantity' => $input['quantity'][$i],
            ];
        }
        Transactiondetail::insert($transactionDetails);
        session()->flash('success', 'Transaction dan details berhasil ditambahkan!');
        return redirect()->route('programming.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['transactionmix'] = Transaction::with('transactionDetails')
            ->find($id);
        // dd($data);
        return view('edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['transactionmix'] = Transaction::with('transactionDetails')
            ->find($id);
        // dd($data);
        return view('update', $data);
    }

    public function getTransactionDetails($id)
    {
        $transactionmix = Transaction::with('transactionDetails')->findOrFail($id);
        return response()->json($transactionmix->transactionDetails);
    }
    public function deleteItem(Request $request)
    {
        $itemId = $request->input('item_id');
        $transactionDetail = Transactiondetail::find($itemId);

        if ($transactionDetail) {
            $transactionDetail->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $input = $request->only(['transaction_no', 'transaction_date', 'item', 'quantity']);
        $transactionProgress = Transaction::findOrFail($id);

        $transactionProgress->update([
            'no_transaction' => $input['transaction_no'],
            'transaction_date' => $input['transaction_date'],
        ]);

        Transactiondetail::where('transaction_id', $id)->delete();

        $transactionDetails = [];
        for ($i = 0; $i < count($input['item']); $i++) {
            $transactionDetails[] = [
                'transaction_id' => $id,
                'item' => $input['item'][$i],
                'quantity' => $input['quantity'][$i],
            ];
        }

        Transactiondetail::insert($transactionDetails);
        session()->flash('success', 'Transaction dan details berhasil diupdate!');
        return redirect()->route('programming.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transactionProgress = Transaction::with('transactionDetails')->findOrFail($id);
        $transactionProgress->transactionDetails()->delete();
        $transactionProgress->delete();
        session()->flash('success', 'Transaction dan detailnya berhasil dihapus!');
        return redirect()->route('programming.index');
    }
}
