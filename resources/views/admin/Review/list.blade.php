@extends('admin.layouts.app')
@section('title','review_list')
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
    <div class="table-data__tool">
        <div class="table-data__tool-left">
            <div class="overview-wrap">
                <h2 class="title-1">Reviews List</h2>
            </div>
        </div>
        <div class="table-data__tool-right">
        </div>
    </div>

    @if (count($data) === 0)

            {{-- Condition there is no data exit in database --}}
            <h3>There is no reviews now</h3>

    @else
        <div class="table-responsive table-responsive-data2 mb-2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th class=" text-center">Image</th>
                        <th class=" text-center">Name</th>
                        <th class=" text-center">Description</th>
                        <th class=" text-center">Date</th>
                        <th class=" text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr class="tr-shadow">
                            <td class=" text-center py-2">
                                @if ($row->image === NULL)
                                    <img class=" my-0" style="width:70px; height:70px;" src="{{ asset('admin/images/user (3).jpg') }}"/>
                                 @else
                                    <img class=" my-0" style="width:70px; height:70px;" src="{{ asset('storage/'.$row->image) }}"/>
                                @endif
                            </td>
                            <td class=" text-center">
                                <span class="block-email">{{ $row->name }}</span>
                            </td>
                            <td class=" text-center">
                                <div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        read review
                                    </a>
                                    <div style="width: 300px" class="dropdown-menu p-2 shadow">
                                        {{ $row->description }}
                                    </div>
                                  </div>
                            </td>
                            <td class=" text-center">{{ $row->created_at->format('d/M/Y H:i A') }}</td>
                            <td class="">
                                <div  class="table-data-feature d-flex justify-content-center">
                                    <a href="{{ route('admin#reviewDelete',$row->id) }}" class="item mx-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div class=" d-flex justify-content-between">
            <small class="">
                Showing <b>{{ $data->firstItem() }}</b> to <b>{{ $data->lastItem() }}</b> of <b>{{ $data->total() }}</b> results
            </small>
            <div class="">
                {{ $data->appends(request()->query())->links() }}
            </div>
        </div> --}}
    @endif
</div>
@endsection
