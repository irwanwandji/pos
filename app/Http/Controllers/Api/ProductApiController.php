<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::paginate(2);
        // return response()->json($product);
        $response = [
            'message' => 'Data berhasil diambil',
            'data' => ProductResource::collection($product),
            'pagination' => [
                "current_page" => $product->currentPage(),
                "first_page_url" =>  $product->getOptions()['path'].'?'.$product->getOptions()['pageName'].'=1',
                "prev_page_url" =>  $product->previousPageUrl(),
                "next_page_url" =>  $product->nextPageUrl(),
                "last_page_url" =>  $product->getOptions()['path'].'?'.$product->getOptions()['pageName'].'='.$product->lastPage(),
                "last_page" =>  $product->lastPage(),
                "per_page" =>  $product->perPage(),
                "total" =>  $product->total(),
                "path" =>  $product->getOptions()['path'],
            ]
        ];
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required',
            'sku' => 'required',
            'image' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);

        $image = $request->file('image')->store('products', 'public');

        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->price = $request->input('price');
        $product->sku = $request->input('sku');
        $product->image = $image;
        $product->status = $request->input('status');
        $product->description = $request->input('description');
        $product->save();

        $response = [
            'message' => 'Data berhasil ditambah',
            'data' => ProductResource::make($product)
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (empty($product)) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $response = [
            'message' => 'Data berhasil diambil',
            'data' => $product
        ];

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required',
            'sku' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);

        $product = Product::find($id);
        if (empty($product)) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $request_image = $request->file('image');
        if(!empty($request_image)) {
            $image = $request_image->store('products', 'public');
            Storage::disk('public')->delete($product->image);
            $product->image = $image;
        }

        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->price = $request->input('price');
        $product->sku = $request->input('sku');
        $product->status = $request->input('status');
        $product->description = $request->input('description');
        $product->save();

        $response = [
            'message' => 'Data berhasil ubah',
            'data' => ProductResource::make($product)
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (empty($product)) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
