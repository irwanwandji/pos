{{-- <div style="background-color: grey; font-family:monospace;">
    <h2>Product : {{ $promotion->product->name }}</h2>
    <h3>{{ $promotion->text_promotion }}</h3>
    <a href="{{ route('product.show', $promotion->product_id) }}" target="_blank">Lihat Produk</a>
</div> --}}


@component('mail::message')
<h2 style="text-align: center">Produk : {{ $promotion->product->name }}</h2>
<h4 style="text-align: center">{{ $promotion->text_promotion }}</h4>


<p style="text-align: center">klik tombol dibawah untuk melihat product</p>
@component('mail::button', [ 'url' => route('product.show', $promotion->product_id)])
Lihat Produk
@endcomponent

Terimakasih,<br>
{{ config('app.name') }}
@endcomponent
