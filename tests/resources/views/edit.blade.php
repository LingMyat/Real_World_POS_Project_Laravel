@extends("layout")
@section("content")
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3>Edit</h3>
                <a href="/blog" class=" btn btn-success">Back to blog</a>
              </div>
        </div>
        <div class="card-body">
            <form action="/blog/{{ $data->id }}" method="post">
                @method('PUT')
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" name="name" value="{{ old('name',$data->name) }}" class="form-control" id="name" >
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea name="description" class=" form-control" id="description" rows="8">{{ old('description',$data->description) }}</textarea>
                  @error('description')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="mb-3">
                <select class="form-select form-select-sm" name="cat_id" aria-label=".form-select-sm example">
                    @foreach ($category as $row)
                        <option  value="{{ $row->id }}" {{ $data->cat_id === $row->id?'selected':'' }}>{{ $row->name }}</option>
                    @endforeach
                  </select>
                  @error('cat_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <input type="number" value="{{ auth()->id() }}" class=" d-none" name="user_id" id="">
                <button type="submit" class="btn btn-primary float-end">Save</button>
              </form>
        </div>
      </div>
</div>
@endsection
