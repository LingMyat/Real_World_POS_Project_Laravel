@extends('admin.layouts.app')
@section('title','order_list')
{{-- Use original search bar for better UI use yield for different page different serch form --}}
@section('searchbar')
    <form class="form-header" action="" method="POST">
        <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection
{{-- Main Contents --}}
@section('content')

<div class="col-md-12">
    <div  class="mb-2" >
        <a href="{{ route('order#list') }}" class=" text-black">
            <i style="cursor: pointer" class="fa-solid fa-arrow-left"></i> back
        </a>
    </div>
    <div class="card w-50">
        <div class="card-header">
            <h3>Order Info</h3>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col"><i class="fa-solid fa-file-signature"></i> Customer-Name</div>
                <div class="col">{{ strtoupper($data[0]->user_name) }}</div>
            </div>
            <div class="row mb-2">
                <div class="col"><i class="fa-solid fa-qrcode"></i> Order-Code</div>
                <div class="col">{{ $data[0]->order_code }}</div>
            </div>
            <div class="row mb-2">
                <div class="col"><i class="fa-solid fa-calendar-day"></i> Order-Date</div>
                <div class="col">{{ $data[0]->created_at->format('Y-m-d') }}</div>
            </div>
            <div class="row mb-2">
                <div class="col"><i class="fa-solid fa-hand-holding-dollar"></i> Total</div>
                <div class="col">$ {{ $order[0]->total }}.00</div>
            </div>
        </div>
    </div>
    {{-- Data Table start  --}}
    <div class="table-responsive table-responsive-data2 mb-2">
        <table class="table table-data2">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Order-Date</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr class="tr-shadow row-count">
                        <td>
                            <a href="{{ route('product#show',$row->id) }}">
                                <img class="" style="width:100px; height:100px;" src="{{ asset('storage/'.$row->image) }}"/>
                            </a>
                        </td>
                        <td>
                            <span class="block-email">{{ $row->product_name }}</span>
                        </td>
                        <td>{{ $row->created_at->format('Y-m-d') }}</td>
                        <td>{{ $row->qty }}</td>
                        <td>${{ $row->price * $row->qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-between">
            <small class="">
                Showing <b>{{ $data->firstItem() }}</b> to <b>{{ $data->lastItem() }}</b> of <b>{{ $data->total() }}</b> results
            </small>
            <div class="">
                {{ $data->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
