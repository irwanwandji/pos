<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:isAdmin')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // ambil semua data dan tampilkan ke halamana index
        // $products = Product::all();

        // Mengambil data method GET
        $cat_id = $request->query('cat_id');
        $keyword = $request->query('keyword');

        // Mengambil name dan id dari table category
        $categories = \App\Models\Category::select('name' , 'id')->get();

        // membuat pagination
        $dataPerPage = 3;

        // Variabel untuk menampung kondisi
        $where = [];

        //TAMBAHAN
        //kondisi bukan user admin yang mengakses index
        if (Gate::allows('isCashier')) {
            $where[] = ['status', '=', 'active'];
        }

        if(!empty($cat_id)) {
            $where[] = ['category_id', '=', $cat_id];
        }

        if(!empty($keyword)) {
            $where[] = ['name', 'LIKE', "%{$keyword}%"];
        }

        //Perubahan
        $products = Product::where($where)->paginate($dataPerPage);

        $data = [
            'products' => $products,
            'categories' => $categories,
            'cat_id' => $cat_id,
            'keyword' => $keyword,
        ];

        return view('admin/product/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Untuk mengambil data table category hanya field name dan id
        $categories = \App\Models\Category::select('name', 'id')->get();

        $data = ['categories' => $categories];

        return view('admin.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // setting rules validasi data
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'sku' => 'required',
            'image' => 'required',
            'status' => 'required',
            'description' => 'required'
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong'
        ];

        // validasi data
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            // jika data tidak valid
            return Redirect('admin/product/create')
                ->withErrors($validator)
                ->withInput($request->all());
        }
        else {
            $image = $request->file('image')->store('products', 'public');

            // jika data valid
            // simpan ke database
            $product = new Product;
            $product->category_id = $request->get('category_id');
            $product->name = $request->get('name');
            $product->price = $request->get('price');
            $product->sku = $request->get('sku');
            $product->name = $request->get('name');
            $product->image = $image;
            $product->status = $request->get('status');
            $product->description = $request->get('description');
            $product->save();

            // redirect ke halaman index category
            return Redirect('admin/product')->with('message', 'Product successfully saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Menampilkan data berdasarkan id = $id
        $product = Product::find($id);

        $data = [
            'product' => $product,
        ];

        return view('admin.product.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Menampilkan data berdasarkan id = $id
        $product = Product::find($id);

        $categories = Category::select('name', 'id')->get();

        $data = [
            'product' => $product,
            'categories' => $categories,
        ];

        return view('admin.product.edit', $data);
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
        // setting rules validasi data
        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'sku' => 'required',
            'status' => 'required',
            'description' => 'required'
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus angka',
        ];

        // validasi data
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            // jika data tidak valid
            return redirect("admin/product/{$id}/edit")
                ->withErrors($validator);
        }
        else {
            // jika data valid
            // simpan ke database
            $product = Product::find($id);
            $product->name = $request->get('name');
            $product->price = $request->get('price');
            $product->sku = $request->get('sku');
            $product->name = $request->get('name');
            $product->status = $request->get('status');
            $product->description = $request->get('description');

            $request_image = $request->file('image');

            if(!empty($request_image)) {
                $image = $request_image->store('products', 'public');
                Storage::disk('public')->delete($product->image);
                $product->image = $image;
            }

            $product->save();

            // redirect ke halaman index category
            return Redirect('admin/product')->with('message', 'Product successfully updated');
        }
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
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect(route('product.index'))->with('message', 'Product has been delete');
    }

    public function modalStock($id)
    {
        $product = Product::find($id);
        $data = [
            'name' => $product->name,
            'price' => $product->price,
        ];

        return response()->json($data);
        // return json_encode($data);
    }

    public function addStock(Request $request)
    {
        $rules = [
            'stock' => ['required','numeric'],
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        } else {
            $product = Product::find($request->product_id);
            $product->stock = $product->stock + $request->input('stock');
            $product->save();

            return redirect(route('product.index'))->with('message','Stock has been update');
        }
    }
}
