@extends('admin.layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">

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

            <h3 class="card-title">Admin List Table</h3>

            <div class="card-tools">
                <form action="{{ route('admin#listSearch')
                 }}" method="POST">
                    @csrf
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="adminSearchKey" class="form-control float-right" placeholder="Search" value="{{ request('adminSearchKey') }}">

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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td class="col-1">{{ $index+1 }}</td>

                                <td class="col-2">{{ $user['name'] }}</td>
                                <td class="col-3">{{ $user['email'] }}</td>
                                <td class="col-1">{{ $user['phone'] }}</td>
                                <td class="col-3">{{ $user['address'] }}</td>
                                <td class="col-1">{{ $user['gender'] }}</td>
                                <td class="col-1">
                                    {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}

                                    @if (auth()->user()->id != $user->id)
                                        <a href="{{ route('admin#acccountDelete',$user->id) }}">
                                            <button class="btn btn-sm bg-danger text-white" ><i class="fas fa-trash-alt"></i></button>
                                        </a>
                                    @endif

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

