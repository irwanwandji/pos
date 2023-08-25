<?php

namespace App\Http\Controllers;

use App\Jobs\PromotionMailCreatedJob;
use App\Mail\PromotionMail;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::all();

        $data = [
            // Isi data kirim ke view
            'promotions' => $promotions,
        ];
        return view('admin.promotion.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = \App\Models\Product::all();
        return view('admin.promotion.create')->with('products', $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            // Rule validasi
            'product_id' => 'required',
            'text_promotion' => 'required',
        ];

        $messages = [
            // Message error validasi
            '' => '',
            '' => '',
            '' => '',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            // jika data tidak valid
            return redirect()
                ->route('promotion.create')
                ->withErrors($validator);
        } else {
            // jika data valid
            // simpan ke database
            $promotion = new Promotion;
            // Input nilai sesuai field model
            $promotion->product_id = $request->input('product_id');
            $promotion->text_promotion = $request->input('text_promotion');
            $promotion->save();

            $emails = [
                'test1@gmail.com',
                'test2@gmail.com',
                'test3@gmail.com',
                'test4@gmail.com',
            ];

            // Mail::to($emails)->send(new PromotionMail($promotion));
            PromotionMailCreatedJob::dispatch($promotion, $emails)->delay(now()->addSeconds(10));

            return redirect()->route('promotion.index')->with('message','promotion successfully saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        return view('admin.promotion.show')->with('promotion', $promotion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        return view('admin.promotion.edit')->with('promotion', $promotion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        $rules = [
            // Rule validasi
            '' => '',
            '' => '',
            '' => '',
        ];

        $messages = [
            // Message error validasi
            '' => '',
            '' => '',
            '' => '',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            // jika data tidak valid
            return redirect()
                ->route('promotion.edit')
                ->withErrors($validator);
        } else {
            // jika data valid
            // simpan ke database

            // Input nilai sesuai field model
            // $promotion->... = $request->input('');
            // $promotion->... = $request->input('');
            // ..
            // ..
            // ..
            // $promotion->save();

            return redirect()->route('promotion.index')->with('message','promotion successfully updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('promotion.index')->with('message','promotion successfully deleted');
    }
}
