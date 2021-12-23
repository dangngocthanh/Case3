@extends('admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add new Product</h4>
                            <form class="forms-sample" enctype="multipart/form-data" method="post"
                                  action="{{ route('product.update') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" class="form-control" id="exampleInputName1"
                                           placeholder="Name" value="{{ $product->name }}" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Price</label>
                                    <input type="number" class="form-control" id="exampleInputEmail3"
                                           placeholder="VND" value="{{ $product->price }}" name="price">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword4">Quantity</label>
                                    <input type="number" class="form-control" id="exampleInputPassword4"
                                           placeholder="Quantity" value="{{ $product->quantity }}" name="quantity">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Sale Percent</label>
                                    <table style="width: 70%;">
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input"
                                                               name="sale_percent"
                                                               id="optionsRadios1" value="0"
                                                               @if($product->sale_percent == 0) checked="" @endif>
                                                        0%
                                                        <i class="input-helper"></i></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input"
                                                               name="sale_percent"
                                                               id="optionsRadios2" value="20"
                                                               @if($product->sale_percent == 20) checked="" @endif>
                                                        20%
                                                        <i class="input-helper"></i></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input"
                                                               name="sale_percent"
                                                               id="optionsRadios1" value="40"
                                                               @if($product->sale_percent == 40) checked="" @endif>
                                                        40%
                                                        <i class="input-helper"></i></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input"
                                                               name="sale_percent"
                                                               id="optionsRadios2" value="60"
                                                               @if($product->sale_percent == 60) checked="" @endif>
                                                        60%
                                                        <i class="input-helper"></i></label>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectGender">Category</label>
                                    <select class="form-control" name="category_id" id="exampleSelectGender">
                                        @foreach($categories as $category)
                                            @if($product->category_id == $category->id)
                                                <option value="{{ $category->id }}"
                                                        selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="image" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info"  disabled
                                               placeholder="Upload Image">
                                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Description</label>
                                    <textarea class="form-control" id="exampleTextarea1" name="description"
                                              rows="4">{{ $product->description }}</textarea>
                                </div>
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-primary mr-2">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
