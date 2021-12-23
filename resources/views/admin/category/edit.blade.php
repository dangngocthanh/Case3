@extends('admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Category</h4>
                            <form class="forms-sample" action="{{ route('categories.update') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" class="form-control" id="exampleInputName1"
                                           placeholder="Name" name="name" value="{{ $category->name }}">
                                </div>
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                <div class="form-group">
                                    <label for="exampleTextarea1">Introduce</label>
                                    <textarea class="form-control" id="exampleTextarea1" name="introduce"
                                              rows="4">{{ $category->introduce }}</textarea>
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

