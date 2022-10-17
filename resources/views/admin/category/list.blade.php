@extends('admin.layouts.app')
@section('title','category_list')
{{-- Use original search bar for better UI use yield for different page different serch form --}}
@section('searchbar')
    <form class="form-header" action="{{ route('category#list') }}" method="get">
        <input class="au-input au-input--xl" value="{{ request('search') }}" type="text" name="search" placeholder="Search for datas &amp; reports..." />
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
                <h2 class="title-1">Categories List</h2>
            </div>
        </div>
        <div class="table-data__tool-right">
            <a href="{{ route('category#createPage') }}">
                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                    <i class="zmdi zmdi-plus"></i>add category
                </button>
            </a>
            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                CSV download
            </button>
        </div>
    </div>
    {{-- Condition for CRUD noti session --}}
    @if (session('created'))
        <div class="alert bg-white alert-secondary alert-dismissible w-50 fade show" role="alert">
            <strong>{{ session('created') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('updated'))
        <div class="alert bg-white alert-secondary alert-dismissible w-50 fade show" role="alert">
            <strong>{{ session('updated') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('deleted'))
        <div class="alert bg-white alert-secondary alert-dismissible w-50 fade show" role="alert">
            <strong>{{ session('deleted') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('pswUpdated'))
        <div class="alert bg-white alert-secondary alert-dismissible w-50 fade show" role="alert">
            <strong>{{ session('pswUpdated') }} <a href="{{ route('auth#logoutPage') }}">click here to check !</a></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('profileUpdated'))
        <div class="alert bg-white alert-secondary alert-dismissible w-50 fade show" role="alert">
            <strong>{{ session('profileUpdated') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (count($data) === 0)
        {{-- Condition for no data to show --}}
        @if (!empty(request('search')))
            {{-- Condition search data is not exit --}}
            <h3>There is no Category with {{ request('search') }} <a href="{{ route('category#list') }}">Back to list</a></h3>
        @else
            {{-- Condition there is no data exit in database --}}
            <h3>There is no Category now <a href="{{ route('category#createPage') }}">+Add New</a></h3>
        @endif

    @else
    {{-- Data Table start  --}}
        <div class="table-responsive table-responsive-data2 mb-2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Created Date</th>
                        <th style="">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr class="tr-shadow">
                            <td>{{ $id }}</td>
                            <td>
                                <span class="block-email">{{ $row->category_name }}</span>
                            </td>
                            <td>{{ $row->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div  class="table-data-feature d-flex justify-content-start">
                                    <a href="{{ route('category#edit',$row->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>
                                    <a href="{{ route('category#delete',$row->id) }}" class="item mx-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </a>
                                    <a href="{{ route('category#show',$row->id) }}" class="item mx-1" data-toggle="tooltip" data-placement="top" title="View">
                                        <i class="zmdi zmdi-more"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php
                            $id++
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class=" d-flex justify-content-between">
            <small class="">
                Showing <b>{{ $data->firstItem() }}</b> to <b>{{ $data->lastItem() }}</b> of <b>{{ $data->total() }}</b> results
            </small>
            <div class="">
                {{ $data->appends(request()->query())->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
