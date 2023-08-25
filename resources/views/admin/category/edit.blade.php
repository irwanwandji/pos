@extends('admin.admin')
@section('title', __('category-edit.title'))
@section('content')
<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ url('admin/category/'. $category->id) }}">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('category-edit.card-title')</h3>
                </div>
                <div class="card-body">
                    @if(!empty($errors->all()))
                    <div class="alert alert-danger">
                        <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="name">@lang('category-edit.label-name')</label>
                        <input type="text" name="name" value="{{ $category->name }}" class="form-control" placeholder="{{ __('category-edit.placeholder-name') }}" />
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="active" {{ ($category->status == 'active')? 'selected' : ''}}>@lang('category-edit.status-opt1')</option>
                            <option value="inactive" {{ ($category->status == 'inactive')? 'selected' : ''}}>@lang('category-edit.status-opt2')</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer d-flex">
                    <a href="{{ url('admin/category') }}" class="btn btn-outline-info">@lang('category-edit.button-back')</a>
                    <button type="submit" class="btn btn-primary ml-auto">@lang('category-edit.button-submit')</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
