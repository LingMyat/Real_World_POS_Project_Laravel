@extends("layout")
@section("content")
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3>Blog</h3>
                <a href="/blog" class=" btn btn-success">Back-to-Blogs</a>
              </div>
        </div>
        <div class="card-body">
            <div class=" d-flex justify-content-between">
                <h4 class="card-title">{{ $data->name }}</h4>
                <h6>{{'Category : '.$data->categories->name }}</h6>
            </div>
            <p class="card-text">{{ $data->description }}</p>

        </div>
      </div>
</div>
@endsection
