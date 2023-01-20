@extends('admin.layouts.app')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Change Password</legend>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">

                    {{-- alert-start --}}
                    @if (Session::has('passUpdateFail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ Session::get('passUpdateFail') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    {{-- alert-end --}}

                    <form class="form-horizontal" method="POST" action="{{ route('admin#changePassword') }}">

                        @csrf

                        <div class="form-group row">
                            <label for="oldPassword" class="col-md-4 col-form-label">Old Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="oldPassword" name="oldPassword"   placeholder="Enter Old Password..">
                                @error('oldPassword')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newPassword" class="col-md-4 col-form-label">New Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="newPassword" name="newPassword"   placeholder="Enter New Password..">
                                @error('newPassword')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="confirmPassword" class="col-md-4 col-form-label">Confirm Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"   placeholder="Enter New Password..">
                                @error('confirmPassword')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class=" row ">
                            <div class="offset-md-4 col-md-8 offset-sm-3 col-sm-9 my-2">
                                <button type="submit" class="btn bg-dark text-white">Change Password</button>
                            </div>
                        </div>
                    </form>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
