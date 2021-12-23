@extends('admin.master')
@section('content')
    <div class="col-md-12 stretch-card ">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Products List</h4>
                <a class="btn badge badge-danger" id="deleteProduct" style="margin-top: 2%">Delete</a>
                <div class="table-responsive">
                    <div class="col-md-12 stretch-card "></div>
                    <table class="table table-striped table-borderless">
                        <thead>
                        <tr style="width: 100%">
                            <th style="width: 1%"><input class="form-check form-check-danger" type="checkbox" id="deleteAll"></th>
                            <th style="width: 1%">STT</th>
                            <th style="width: 2%">Name</th>
                            <th style="width: 2%">Price</th>
                            <th style="width: 2%">Quantity</th>
                            <th style="width: 1%">Category Id</th>
                            <th style="width: 1%">Image</th>
                            <th style="width: 1%">update</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $product)
                            <tr id="checkbox-{{ $product->id }}">
                                <td><input type="checkbox" class="checkbox" value="{{ $product->id }}" ></td>
                                <td class="font-weight-bold">{{ $key }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->category_id }}</td>
                                <td><img src="{{ asset('storage/'.$product->image) }}" alt=""></td>
                                <td><a class="btn badge badge-warning" href="{{ route('product.edit',$product->id) }}">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
