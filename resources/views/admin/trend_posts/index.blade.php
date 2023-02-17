@extends('admin.layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Post List Table</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
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
              <th>View Count</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $index => $post)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $post->title }}</td>
                    <td>
                        @if ($post->image == null)
                            <img src="{{ asset('defaultImage/default-image.jpg') }}"  class="rounded w-25 shadow-sm">
                        @else
                            <img src="{{ asset('storage/postImage/'.$post->image) }}"  class="rounded w-25 shadow-sm">
                        @endif
                    </td>
                    <td><i class="fa-solid fa-eye mr-2"></i>{{ $post->post_count }}</td>

                    <td>
                        <a href="{{ route('admin#trendPostDetails',$post->post_id) }}"  class="btn btn-sm bg-dark text-white"><i class="fa-solid fa-barcode"></i></a>
                        {{-- <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button> --}}
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<div class="d-flex justify-content-end">
    {{-- {{ $posts->links() }} --}}
</div>
</div>
@endsection

