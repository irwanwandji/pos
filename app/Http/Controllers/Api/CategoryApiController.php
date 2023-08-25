<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $response = [
            'message' => 'data categories berhasil diambil',
            'data' => CategoryResource::collection($categories),
        ];

        return response()->json($response);
        // return json_encode($response);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $response = [
            'message' => 'data  berhasil diambil',
            'data' => CategoryResource::make($category),
        ];

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->status = $request->input('status');
        $category->save();

        $response = [
            'message' => 'data berhasil disimpan',
            'data' => CategoryResource::make($category),
        ];

        return response()->json($response, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->status = $request->input('status');
        $category->save();

        $response = [
            'message' => 'data berhasil diubah',
            'data' => CategoryResource::make($category),
        ];

        return response()->json($response);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        $response = [
            'message' => 'Data berhasil dihapus'
        ];

        return response()->json($response);
    }

}
