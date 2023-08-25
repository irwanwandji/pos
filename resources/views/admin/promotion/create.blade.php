@extends('admin.admin')
@section('title', 'Promotion')
@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{ route('promotion.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('promotion/create.card-title')</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="product_id">@lang('promotion/create.label-product')</label>
                        <select name="product_id" id="product_id" class="form-control">
                            <option value=""><?php echo __('promotion\create.option-product') ?></option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="text_promotion">@lang('promotion/create.label-promotion')</label>
                        <textarea name="text_promotion" id="text_promotion" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="card-footer d-flex">
                    <a href="" class="btn btn-outline-info">@lang('promotion/create.btn-back')</a>
                    <button type="submit" class="btn btn-primary ml-auto">@lang('promotion\create.btn-submit')</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
