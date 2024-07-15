<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Exception;
use Flasher\Noty\Laravel\Facade\Noty;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $user = Auth::user();

        $my_carts = $user->carts()->with('product')->get();

        return view('front.carts', [
            'my_carts' => $my_carts
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
    public function store($productId)
    {
        $user = Auth::user();
        $product = Product::findOrFail($productId);

        $existingCartItem = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();

        DB::beginTransaction();
        try {
            if ($existingCartItem) {
                if ($existingCartItem->quantity + 1 > $product->stock) {
                    toastr()->error('Kuantitas melebihi stok dari produk.');
                    return redirect()->back();
                }
                $existingCartItem->quantity += 1;
                $existingCartItem->save();
            } else {
                if (1 > $product->stock) {
                    toastr()->error('Kuantitas melebihi stok dari produk.');
                    return redirect()->back();
                }
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => 1
                ]);
            }

            DB::commit();
            toastr()->success('Produk Berhasil Ditambahkan');
            return redirect()->route('front.product.details');
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'system_error' => ['System error: ' . $e->getMessage()],
            ]);
        }
    }
        

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $validated = $request->validate([
            'quantity' => 'sometimes|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $product = $cart->product;

            if (isset($validated['quantity']) && $product->stock < $validated['quantity']) {

                noty()->theme('mint')->timeout(1500)->error('Stock tidak mencukupi untuk: ' . $product->name);

                throw ValidationException::withMessages([
                    'stock_error' => ['Stock tidak mencukupi untuk: ' . $product->name]
                ]);
            }

            if (isset($validated['quantity'])) {
                $cart->update([
                    'quantity' => $validated['quantity'],
                ]);
            }

            DB::commit();
            noty()->theme('mint')->timeout(1000)->success('Produk Berhasil diupdate');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'system_error' => ['System error: ' . $e->getMessage()],
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
        try {
            $cart->delete();

            noty()->theme('mint')->timeout(1000)->error('Produk Berhasil di hapus');
            return redirect()->back();
        } catch (\Exception $e) {

            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error !' . $e->getMessage()],
            ]);

            throw $error;
        }
    }
}
