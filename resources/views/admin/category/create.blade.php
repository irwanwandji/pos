@extends('admin.admin')
@section('title', __('category-create.title'))
@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ url('admin/category/store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('category-create.card-title')</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">@lang('category-create.label-name')</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('category-create.placeholder-name') }}">
                        </div>
                        <div class="form-group">
                            <label for="status">@lang('category-create.label-status')</label>
                            <select name="status" id="status" class="form-control">
                                <option value="active">@lang('category-create.status-opt1')</option>
                                <option value="inactive">@lang('category-create.status-opt2')</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer d-flex">
                        <a href="{{ url('admin/category') }}" class="btn btn-outline-info">@lang('category-create.button-back')</a>
                        <button type="submit" class="btn btn-primary ml-auto">@lang('category-create.button-submit')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
