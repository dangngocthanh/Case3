@extends('admin.master')
@section('content')
    <div class="col-md-12 stretch-card ">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Categories List</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead>
                        <tr style="width: 100%">
                            <th style="width: 1%">STT</th>
                            <th style="width: 10%">Name</th>
                            <th style="width: 20%">Introduce</th>
                            <th style="width: 5%"></th>
                            <th style="width: 20%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $key => $category)
                            <tr >
                                <td class="font-weight-bold">{{ $key+1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->introduce }}</td>
                                <td><a class="btn badge badge-warning" href="{{ route('categories.edit',$category->id) }}">Edit</a></td>
                                <td><a class="btn badge badge-danger" href="{{ route('categories.delete',$category->id) }}">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
