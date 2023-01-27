@extends('admin.layouts.app')

@section('content')
<div class="col-4 offset-1">
    <a href="{{ route('admin#post') }}" class="btn btn-dark mb-2">Back</a>
    <div class="card">
        <div class="card-body" >
            <form action="{{ route('admin#postUpdate',$post->post_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" placeholder="Enter title ..." name="postTitle" value="{{ old('postTitle',$post->title) }}">
                    @error('postTitle')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea class="form-control" placeholder="Enter description..." name="postDescription">{{ old('postDescription',$post->description) }}</textarea>
                    @error('postDescription')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" class="form-control" placeholder="" name="postImage" value="{{ old('postImage') }}"><br>
                    @if ($post->image == null)
                        <img src="{{ asset('defaultImage/default-image.jpg') }}"  class="rounded w-50 shadow-sm">

                    @else
                        <img src="{{ asset('storage/postImage/'.$post->image) }}"  class="rounded w-50 shadow-sm">
                    @endif
                    @error('postImage')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Category</label>
                    <select name="postCategory" id="" class="form-control">
                        <option value="">Choose Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['category_id'] }}" @if ( $category->category_id == $post->category_id )
                                selected
                            @endif >{{ $category['title'] }}</option>
                        @endforeach
                    </select>
                    @error('postCategory')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-secondary form-control">Update</button>
            </form>
        </div>
    </div>
</div>
<div class="col-7">


    {{-- <div class="card">
      <div class="card-header">
        <h3 class="card-title">Post List Table</h3>

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
              <th>ID</th>
              <th>Post Title</th>
              <th>Image</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $index => $post)
                <tr>
                    <td class="">{{ $index +1 }}</td>
                    <td class="">{{ $post->title }}</td>
                    <td class="">
                        @if ($post->image == null)
                        <img src="{{ asset('defaultImage/default-image.jpg') }}"  class="rounded w-25 shadow-sm">

                        @else
                            <img src="{{ asset('storage/postImage/'.$post->image) }}"  class="rounded w-25 shadow-sm">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin#postEditPage',$post->post_id) }}">
                            <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                        </a>
                        {{-- <a href="{{ route('admin#deletePost',$post->post_id) }}">
                            <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                        </a> --}}
                    {{-- </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div> --}}
      <!-- /.card-body -->
    {{-- </div> --}}
    <!-- /.card -->

    <div class="card w-75 mt-5 ms-5">
        {{-- <img src="..." class="card-img-top" alt="..."> --}}
        @if ($post->image == null)
            <img src="{{ asset('defaultImage/default-image.jpg') }}"  class="card-img-top">

        @else
            <img src="{{ asset('storage/postImage/'.$post->image) }}"  class="card-img-top">
        @endif
        <div class="card-body">
            <h4>{{ $post->title }}</h4>
          <p class="card-text">{{ $post->description }}</p>
        </div>
    </div>
</div>
@endsection

