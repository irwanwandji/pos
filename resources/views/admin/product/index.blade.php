@extends('admin.admin')
@section('title', 'Product')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Products</h3>
                @can('isAdmin')
                <div class="card-tools">
                    <a href="{{ route('product.create') }}" class="btn btn-tool">
                        <i class="fa fa-plus"></i>&nbsp; Add
                    </a>
                </div>
                @endcan
            </div>
            <div class="card-body">
                @if (Session::has('message'))
                <div id="alert-msg" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ Session::get('message') }}
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">All Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ ($cat_id == $category->id) ? "selected" : "" }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="search">Search</label>
                        <input type="text" name="search" id="search" value="" class="form-control" placeholder="Enter keyword">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>SKU</th>
                                    <th>Image</th>
                                    <th>Stock</th>
                                    @can('isAdmin')
                                    <th>Status</th>
                                    @endcan
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td class="text-center"><img src="{{ asset('storage/' . $product->image) }}" width="100"/></td>
                                        <td class="text-center">{{ $product->stock }}</td>
                                        @can('isAdmin')
                                        <td class="text-center">{{ $product->status }}</td>
                                        @endcan
                                        <td class="text-center">
                                                <div class="btn-group">
                                                    <a class="btn btn-info" href="{{ route('product.show', $product->id) }}"><i class="fa fa-eye"></i></a>
                                                    @can('isAdmin')
                                                    <a class="btn btn-success" href="{{ route('product.edit', $product->id) }}"><i class="fa fa-pencil-alt"></i></a>
                                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Yakin hapus data?')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                    <a href="#modalStok" onclick="modalStock({{ $product->id }})" id="addStock" class="btn btn-warning" data-toggle="modal" data-target="#modalStok">
                                                        <i class="far fa-plus-square"></i>
                                                    </a>
                                                    @endcan
                                                </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                {{ $products->appends($_GET)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@can('isAdmin')
<!-- Modal -->
<div class="modal fade" id="modalStok" tabindex="-1" aria-labelledby="modalStokLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalStokLabel">@lang('modal-stock.modal-title')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{ route('addStock') }}" method="POST" id="formAddStock">
                        @csrf
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-group">
                                    <input type="hidden" name="product_id" id="product_id">
                                    <label>@lang('modal-stock.product-name')</label>
                                    <input class="form-control" type="text" id="product_name" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>@lang('modal-stock.product-price')</label>
                                    <input class="form-control" type="text" id="product_price" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row form-group justify-content-end text-right">
                            <div class="bg-light col-7 py-2 rounded  mt-2">
                                <label class="col-form-label">@lang('modal-stock.label-input-stock')</label>
                                <div class="col-3 d-inline-block">
                                    <input class="form-control" type="text" name="stock" id="stock">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('modal-stock.btn-close')</button>
                <button type="submit" form="formAddStock" class="btn btn-primary">@lang('modal-stock.btn-add')</button>
            </div>
        </div>
    </div>
</div>
@endcan

<script>
    function modalStock(id) {
            $.ajax({
                url: "{{ route('modalStock', '') }}"+"/"+id,
                success: function(data){
                    $('#product_name').val(data.name);
                    $('#product_price').val(data.price);
                    $('#product_id').val(id);
                }
            });
        }

    $(document).ready(function (){
        $('#category').on('change', function(){
            filter();
        });

        $('#search').keypress(function(event){
            if (event.keyCode == 13) {
                filter();
            }
        });

        function filter() {
            var cat_id = $('#category').val();
            var keyword = $('#search').val();

            window.location.replace("{{ url('admin/product') }}?cat_id=" + cat_id + "&keyword=" + keyword);
        }
    });
</script>
@endsection
