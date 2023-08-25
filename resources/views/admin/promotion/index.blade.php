@extends('admin.admin')
@section('title', 'Promotion')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('promotion/index.card-title')</h3>
                <div class="card-tools">
                    <a href="{{ route('promotion.create') }}" class="btn btn-tool">
                        <i class="fa fa-plus"></i>&nbsp; @lang('promotion/index.create-button')
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
                            <th>@lang('promotion/index.table.col1')</th>
                            <th>@lang('promotion/index.table.col2')</th>
                            <th>@lang('promotion/index.table.col3')</th>
                            <th>@lang('promotion/index.table.col4')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($promotions as $promotion)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $promotion->product->name }}</td>
                            <td class="text-center">{{ $promotion->text_promotion }}</td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('promotion.destroy', $promotion->id) }}" onsubmit="return confirm('Yakin ingin hapus data ?')">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group">
                                        {{-- <a class="btn btn-info" href=""><i class="fa fa-eye"></i></a> --}}
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
