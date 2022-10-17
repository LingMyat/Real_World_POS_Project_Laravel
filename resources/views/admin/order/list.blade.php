@extends('admin.layouts.app')
@section('title','order_list')
{{-- Use original search bar for better UI use yield for different page different serch form --}}
@section('searchbar')
    <form class="form-header" style="width:412px;height: 45px" action="{{ route('order#list') }}" method="get">
        <select class="form-select" name="search" aria-label="Default select example">
            <option selected>Filter with status</option>
            <option value="0">Pending</option>
            <option value="1">Success</option>
            <option value="2">Reject</option>
        </select>
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection
{{-- Main Contents --}}
@section('content')
<div class="col-md-12">
    <div class="table-data__tool">
        <div class="table-data__tool-left">
            <div class="overview-wrap">
                <h2 class="title-1">Orders List</h2>
            </div>
        </div>
        <div class="table-data__tool-right">
            {{-- <a href="{{ route('category#createPage') }}">
                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                    <i class="zmdi zmdi-plus"></i>add category
                </button>
            </a> --}}
            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                CSV download
            </button>
        </div>
    </div>


    @if (count($data) === 0)
        {{-- Condition for no data to show --}}
        @if (!empty(request('search')))
            {{-- Condition search data is not exit --}}
            <h3>There is no Order with @if (request('search') == 0)
                pending
            @elseif (request('search') == 1)
                success
            @elseif (request('search') == 2)
                reject
            @endif status <a href="{{ route('order#list') }}">Back to list</a></h3>
        @else
            {{-- Condition there is no data exit in database --}}
            <h3>There is no Order now </h3>
        @endif
    @else
    {{-- Data Table start  --}}
        <div class="table-responsive table-responsive-data2 mb-2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>User-Name</th>
                        <th>Order-Date</th>
                        <th>Order-Code</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr class="tr-shadow row-count">
                            <td>
                                <span class="block-email">{{ $row->name }}</span>
                            </td>
                            <td>{{ $row->created_at->format('Y-m-d') }}</td>
                            <td><a href="{{ route('admin#orderInfo',$row->order_code) }}">{{ $row->order_code }}</a></td>
                            <td>${{ $row->total }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        @if ($row->status == 0)
                                            pending
                                        @elseif ($row->status == 1)
                                            success
                                        @elseif ($row->status == 2)
                                            reject
                                        @endif
                                    </a>
                                    <input class="order-id d-none" type="number" value="{{ $row->id }}">
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item pending-btn @if ($row->status == 0)
                                            active @endif" href="#">pending</a></li>
                                        <li><a class="dropdown-item success-btn @if ($row->status == 1)
                                            active @endif" href="#">success</a></li>
                                        <li><a class="dropdown-item reject-btn @if ($row->status == 2)
                                            active @endif" href="#">reject</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @endif
</div>
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function(){
            let orderId = document.getElementsByClassName('order-id');
            let rowCount = document.getElementsByClassName('row-count');
            let pendingBtn = document.getElementsByClassName('pending-btn');
            let successBtn = document.getElementsByClassName('success-btn');
            let rejectBtn = document.getElementsByClassName('reject-btn');
            let successChange = function(i,z){
                $request = {
                        'id' : orderId[i].value,
                        'status' : z ,
                    }
                    $.ajax({
                        type : 'get',
                        url : '/order/status',
                        data : $request,
                        dataType : 'json',
                        success : function(response){
                            if (response.status == 'success') {
                                location.reload();
                            }
                        }
                    })
                }
            for (let i = 0; i < rowCount.length; i++) {
                pendingBtn[i].addEventListener('click',function(){
                     successChange(i,'0');
                })
                successBtn[i].addEventListener('click',function(){
                     successChange(i,'1');
                })
                rejectBtn[i].addEventListener('click',function(){
                     successChange(i,'2');
                })
            }
        })
    </script>
@endsection
