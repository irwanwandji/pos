@extends('admin.admin')
@section('title', __('category-index.title'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('category-index.card-title')</h3>
                <div class="card-tools">
                    <a href="{{ url('admin/category/create') }}" class="btn btn-tool">
                        <i class="fa fa-plus"></i>&nbsp; @lang('category-index.create-button')
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (Session('message'))
                <div id="alert-msg" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ Session('message') }}
                </div>
                @endif

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>@lang('category-index.table.col1')</th>
                            <th>@lang('category-index.table.col2')</th>
                            <th>@lang('category-index.table.col3')</th>
                            <th>@lang('category-index.table.col4')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $kategori)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $kategori->name }}</td>
                                <td class="text-center">{{ $kategori->status }}</td>
                                <td class="text-center">
                                    <form method="POST" action="{{ url('/admin/category/'.$kategori['id']) }}">
                                        @csrf
                                        @method('delete')
                                        <div class="btn-group">
                                            <a class="btn btn-info" href="{{ url('admin/category/'. $kategori->id) }}"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-success" href="{{ url('admin/category/' . $kategori->id . '/edit') }}"><i class="fa fa-pencil-alt"></i></a>
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash" onclick="return confirm('Yakin ingin hapus data ?')"></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
