@extends('admin.layouts.app')

@section('content')
<div class="col-4">
    <div class="card">
        <div class="card-body" >
            <form action="{{ route('admin#createPost') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" placeholder="Enter title ..." name="postTitle" value="{{ old('postTitle') }}">
                    @error('postTitle')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea class="form-control" placeholder="Enter description..." name="postDescription">{{ old('postDescription') }}</textarea>
                    @error('postDescription')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" class="form-control" placeholder="" name="postImage" value="{{ old('postImage') }}">
                    @error('postImage')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Category</label>
                    <select name="postCategory" id="" class="form-control">
                        <option value="">Choose Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['category_id'] }}">{{ $category['title'] }}</option>
                        @endforeach
                    </select>
                    @error('postCategory')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-secondary form-control">Create</button>
            </form>
        </div>
    </div>
</div>
<div class="col-7">

    {{-- alert deleteSuccess --}}
    @if (Session::has('deleteSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('deleteSuccess') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    {{-- alert deleteSuccess --}}

    {{-- alert updateSuccess --}}
    @if (Session::has('updateSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('updateSuccess') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    {{-- alert updateSuccess --}}


    @if (count($posts) != 0)
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Post List Table</h3>

            <div class="card-tools">
                <form action="{{ route('admin#post') }}" method="GET">
                @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="postSearch" class="form-control float-right" placeholder="Search" value="{{ request('postSearch') }}">

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
                            <th>Category</th>
                            <th>Image</th>
                            <th></th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $index => $post)
                            <tr>
                                <td>{{ $index +1 }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category_title }}</td>
                                <td>
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
                                    <a href="{{ route('admin#deletePost',$post->post_id) }}">
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
            <div class="mt-3">
                {{ $posts->links() }}
                {{-- {{ $posts->appends(request()->query())->links() }} --}}
            </div>
    @else
        <h1 class="text-center text-secondary mt-5">There is no Post Here!</h1>
    @endif

</div>
@endsection

