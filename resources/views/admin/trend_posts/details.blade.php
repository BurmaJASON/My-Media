@extends('admin.layouts.app')

@section('content')
<div class="col-6 offset-3 mt-5">
    <button class="btn btn-dark" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i></button>
    <div class="card-header text-center">
        @if ($post->image == null)
            <img src="{{ asset('defaultImage/default-image.jpg') }}"  class="rounded w-50 shadow-sm">
            @else
            <img src="{{ asset('storage/postImage/'.$post->image) }}"  class="rounded w-75 shadow-sm ">
        @endif
    </div>
    <div class="card-body">
        <h3 class="text-center">{{ $post->title }}</h3>
        <p class="text-start">{{ $post['description'] }}</p>
    </div>
</div>
@endsection

