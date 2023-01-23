@extends('admin.layouts.app')

@section('content')

<div class="col-4">
    <div class="card">
        <div class="card-body" >
            <form action="{{ route('admin#categoryUpdate',$updateCategory->category_id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Category Name</label>
                    <input type="text" class="form-control" placeholder="Enter category name..." name="categoryName" value="{{ old('categoryName',$updateCategory->title) }}">
                    @error('categoryName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea class="form-control" placeholder="Enter description..." name="categoryDescription">{{ old('categoryDescription',$updateCategory->description) }}</textarea>
                    @error('categoryDescription')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <a href="{{ route('admin#category') }}">
                    <button type="button" class="btn btn-secondary">Back</button>
                </a>
                <button type="submit" class="btn btn-dark ">Update</button>

            </form>
        </div>
    </div>
</div>
<div class="col-7">




    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Category List Table</h3>

        <div class="card-tools">
          <form action="{{ route('admin#categorySearch') }}" method="POST">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="categorySearch" class="form-control float-right" placeholder="Search" value="{{ request('categorySearch') }}">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
          </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>Category ID</th>
              <th>Category Name</th>
              <th>Description</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $index => $category)
                <tr>
                    <td>{{ $index +1 }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('admin#categoryEditPage',$category->category_id) }}">
                            <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                        </a>
                        <a href="{{ route('admin#deleteCategory',$category->category_id) }}">
                            <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                        </a>
                    </td>
                </tr>
            @endforeach

          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection

