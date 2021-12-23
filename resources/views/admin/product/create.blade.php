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
                                  action="{{ route('product.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" class="form-control" id="exampleInputName1"
                                           placeholder="Name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Price</label>
                                    <input type="number" class="form-control" id="exampleInputEmail3"
                                           placeholder="VND" name="price">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword4">Quantity</label>
                                    <input type="number" class="form-control" id="exampleInputPassword4"
                                           placeholder="Quantity" name="quantity">
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
                                                               id="optionsRadios1" value="0" checked="">
                                                        0%
                                                        <i class="input-helper"></i></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input"
                                                               name="sale_percent"
                                                               id="optionsRadios2" value="20">
                                                        20%
                                                        <i class="input-helper"></i></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input"
                                                               name="sale_percent"
                                                               id="optionsRadios1" value="40">
                                                        40%
                                                        <i class="input-helper"></i></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input"
                                                               name="sale_percent"
                                                               id="optionsRadios2" value="60">
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
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="image" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                               placeholder="Upload Image">
                                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Description</label>
                                    <textarea class="form-control" id="exampleTextarea1" name="description"
                                              rows="4"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
