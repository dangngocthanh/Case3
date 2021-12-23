@extends('admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Welcome Admin!!</h3>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card tale-bg">
                        <div class="card-people mt-auto">
                            <img src="{{ asset('admin/images/dashboard/people.svg') }}" alt="people">
                            <div class="weather-info">
                                <div class="d-flex">
                                    <div>
                                        <h2 class="mb-0 font-weight-normal"><i
                                                class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                                    </div>
                                    <div class="ml-2">
                                        <h4 class="location font-weight-normal">Hanoi</h4>
                                        <h6 class="font-weight-normal">Vietnamese</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin transparent">
                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">All products sold today</p>
                                    <p class="fs-30 mb-2">{{ $today_revenues }}</p>
                                    <p>{{ number_format($today_sale) }} VND</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4">All products sold</p>
                                    <p class="fs-30 mb-2">{{ $total_revenues }}</p>
                                    <p>{{ number_format($total_sale) }} VND</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">Orders for today</p>
                                    <p class="fs-30 mb-2">{{ $today_orders }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 stretch-card transparent">
                            <div class="card card-light-danger">
                                <div class="card-body">
                                    <p class="mb-4">Total orders</p>
                                    <p class="fs-30 mb-2">{{ $total_orders }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title mb-0">Top Products</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->name}}</td>
                                            <td class="font-weight-bold">{{ number_format($product->price) }} VND</td>
                                            <td>{{ $product->created_at->format('d-m-Y') }}</td>
                                            @if($product->quantity >0)
                                                <td class="font-weight-medium">
                                                    <div class="badge badge-success">stocking</div>
                                                </td>
                                            @else
                                                <td class="font-weight-medium">
                                                    <div class="badge badge-danger"> Out of stock
                                                    </div>
                                                </td>
                                            @endif()
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Top Users</p>
                            <ul class="icon-data-list">
                                @foreach($users as $key => $user)
                                    <li>
                                        <div class="d-flex">
                                            @if($user->image == null)
                                                <img src="{{ asset('storage/user.jpeg') }}" alt="">
                                            @else
                                                <img src="{{ asset('storage/'.$user->image ) }}) }}"
                                                     alt="">
                                            @endif
                                            <div>
                                                <p class="text-info mb-1">{{ $user->name }}</p>
                                                <small>Bought: {{ number_format($moneys[$key]) }} VND</small>
                                                <p class="mb-0"></p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- content-wrapper ends -->

    </div>
@endsection
