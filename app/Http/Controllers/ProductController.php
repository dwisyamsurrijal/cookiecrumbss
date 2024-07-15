<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use flasher\Noty\Laravel\Facade\Noty;
use flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::paginate(4);
        return view ('admin.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'about' => 'required|string',
            'stock' => 'required|integer',
            'photo' => 'required|image|mimes:png,jpg,svg',
        ]);

        DB::beginTransaction();

        try {
            if($request->hasFile('photo')){
                $photoPath = $request->file('photo')->store('product_photos', 'public');
                $validated['photo'] = $photoPath;
            }
            $validated['slug'] = Str::slug($request->name);
            //kue nastar -> kue-nastar
            $newProduct = Product::create($validated);

            DB::commit();

            toastr()->success('Produk Berhasil Ditambahkan');

            return redirect()->route('admin.products.index');

        } catch (\Exception $e){

            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error !' . $e->getMessage()],
            ]);

            throw $error;
        }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        return view('admin.products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'price' => 'required|integer',
            'about' => 'required|string',
            'stock' => 'required|integer',
            'photo' => 'sometimes|image|mimes:png,jpg,svg',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('product_photos', 'public');
                $validated['photo'] = $photoPath;
            }
            $validated['slug'] = Str::slug($request->name);
            //kue nastar -> kue-nastar
            $product->update($validated);

            DB::commit();

            toastr()->success('Produk Berhasil Di-update');

            return redirect()->route('admin.products.index');

        } catch (\Exception $e) {

            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error !' . $e->getMessage()],
            ]);

            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        try{
            $product->delete();
            return redirect()->back();
        } catch (\Exception $e){

            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error !' . $e->getMessage()],
            ]);

            throw $error;
    }
}

}