<?php

namespace App\Http\Controllers;

use App\Models\ProductTransaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();

        if($user->hasRole('buyer')){
            $product_transactions = $user->product_transactions()->orderBy('id', 'DESC')->paginate(4);
        }
        else{
            $product_transactions = ProductTransaction::orderBy('id', 'DESC')->paginate(4);

        }
        return view('admin.product_transactions.index', [
            'product_transactions' => $product_transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'notes' => 'required|string|max:65535',
            'post_code' => 'required|integer',
            'phone_number' => 'required|integer',
        ]);
        

        DB::beginTransaction();

        try {
            $subTotalCents = 0;
            $deliveryFeeCents = 10000 * 100;
            $cartItems = $user->carts;

            foreach($cartItems as $item){
                $subTotalCents += $item->product->price * $item->quantity * 100;
            }
            $grandTotalCents = $subTotalCents + $deliveryFeeCents;

            $grandTotal = $grandTotalCents / 100;

            $validated['user_id'] = $user->id;
            $validated['total_amount'] = $grandTotal;
            $validated['status'] = 'diproses';
            $validated['proof'] = null;

          
            $newTransaction = ProductTransaction::create($validated);
            

            foreach($cartItems as $item){
                TransactionDetail::create([
                    'product_transaction_id' => $newTransaction->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                $item->delete();
            }

            DB::commit();

            

            return redirect()->route('product_transactions.upload_proof', $newTransaction);
        }

        catch (\Exception $e){

            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error !' . $e->getMessage()],
            ]);

            throw $error;

        }
    }

    // 'proof' => 'required|image|mimes:png,jpg,jpeg',
    // 

    /**
     * Display the specified resource.
     */
    public function show(ProductTransaction $productTransaction)
    {
        //
        $productTransaction = ProductTransaction::with('transactionDetails.product')->find($productTransaction->id);
        return view('admin.product_transactions.details', [ 
            'productTransaction' => $productTransaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTransaction $productTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductTransaction $productTransaction)
    {
        //
        $productTransaction->update([
            'status' => 'berhasil'
        ]);

        //make logic that if is_paid = true then stock on product automatically reduce as many as user buy

        foreach ($productTransaction->transactionDetails as $detail) {
            $product = $detail->product;

            // Pastikan stok cukup sebelum menguranginya
            if ($product->stock >= $detail->quantity) {
                $product->stock -= $detail->quantity;
                $product->save();
            } else {
                // Jika stok tidak mencukupi, Anda dapat menangani kesalahan di sini
                throw ValidationException::withMessages([
                    'stock_error' => ['Stok tidak mencukupi untuk produk: ' . $product->name]
                ]);
            }
        }
        

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTransaction $productTransaction)
    {
        try {
            $productTransaction->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            $error = ValidationException::withMessages([
                'system_error' => ['System error! ' . $e->getMessage()],
            ]);

            throw $error;
        }
    }

    public function generatePdf(ProductTransaction $productTransaction)
    {
        $productTransaction = ProductTransaction::with('transactionDetails.product')->find($productTransaction->id);

        $pdf = PDF::loadView('pdf.product_transaction', compact('productTransaction'));

        return $pdf->stream('transaction-details.pdf');
    }

    public function generateAllPdf()
    {
        $productTransactions = ProductTransaction::with('transactionDetails.product')
        ->orderBy('created_at', 'DESC')
        ->get();

    $pdf = PDF::loadView('pdf.all_product_transactions', compact('productTransactions'));

    return $pdf->stream('all-transactions.pdf');
    }

    public function search(Request $request)
    {
    $user = Auth::user();
    $keyword = $request->input('keyword');

    if ($user->hasRole('buyer')) {
        $product_transactions = $user->product_transactions()
            ->where(function ($query) use ($keyword) {
                $query->where('id', 'like', '%' . $keyword . '%')
                    ->orWhereHas('transactionDetails', function ($query) use ($keyword) {
                        $query->whereHas('product', function ($query) use ($keyword) {
                            $query->where('name', 'like', '%' . $keyword . '%');
                        });
                    });
            })
            ->orderBy('id', 'DESC')
            ->paginate(4);
    } else {
        $product_transactions = ProductTransaction::where('id', 'like', '%' . $keyword . '%')
            ->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->orderBy('id', 'DESC')
            ->paginate(4);
    }

    return view('admin.product_transactions.index', [
        'product_transactions' => $product_transactions
    ]);
    }
    public function showUploadProofForm(ProductTransaction $productTransaction)
{
  $productTransaction = ProductTransaction::with('transactionDetails.product')->findOrFail( $productTransaction->id );
  return view('product_transactions.upload_proof', compact('productTransaction'));
}

public function uploadProof(Request $request, ProductTransaction $productTransaction)
{
    $validated = $request->validate([
        'proof' => 'required|image|mimes:png,jpg,jpeg|max:2048',
    ]);

    if ($request->hasFile('proof')) {
        $proofPath = $request->file('proof')->store('payment_proofs', 'public');
        $productTransaction->update([
            'proof' => $proofPath, 
            'status' => 'dibayar'
        ]);
    }

    return redirect()->route('product_transactions.index')->with('success', 'Bukti pembayaran berhasil diunggah.');
}

public function cancel(ProductTransaction $productTransaction)
{
    if( $productTransaction->status != 'berhasil') {
        $productTransaction->update(['status'=> 'dibatalkan']);
    }

    return redirect()->route('product_transactions.index')->with('success', 'Pesanan Berhasil Dibatalkan.');
}

}