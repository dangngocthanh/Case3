@extends('admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Category</h4>
                            <form class="forms-sample" action="{{ route('categories.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" class="form-control" id="exampleInputName1"
                                           placeholder="Name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Introduce</label>
                                    <textarea class="form-control" id="exampleTextarea1" name="introduce"
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

