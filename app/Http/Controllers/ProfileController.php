<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct admin home page
    public function index () {
        $id = Auth::user()->id;

        $user = User::select('id','name','email','phone','address','gender')->where('id',$id)->first();

        // return view('admin.profile.index')->with(['user'=>$user]);
                    // OR
        return view('admin.profile.index',compact('user'));
    }

    //updating admin info
    public function updateAdminAccount(Request $request) {
        $userData = $this->getUserInfo($request);

        $validator = $this->userValidationCheck($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                         ->withInput();
        };

        User::where('id',Auth::user()->id)->update($userData);

        return back()->with(['updateSuccess' => 'Admin account updated!']);
    }

    //direct change Password
    public function directChangePassword() {
        return view('admin.profile.changePassword');
    }

    //change Password
    public function changePassword(Request $request) {
        $validator = $this->PasswordValidationCheck($request);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        };

        $dbData = User::where('id',Auth::user()->id)->first();
        $dbPassword = $dbData->password;

        if(Hash::check($request->oldPassword,$dbPassword)) {
            $hashUserPassword = Hash::make($request->newPassword);

            $updateUser = [
                'password' => $hashUserPassword,
                'updated_at' => Carbon::now(),
            ];

            User::where('id',Auth::user()->id)->update($updateUser);

            return redirect()->route('dashboard')->with(['passUpdateSuccess' => 'Your Password is updated!']);;

        }else {
            return back()->with(['passUpdateFail'=>'Old Password Do no Match!']);
        }

    }

    //getUserInfo
    private function getUserInfo($request) {
        return [
            'name' =>  $request->adminName,
            'email' =>  $request->adminEmail,
            'phone' =>  $request->adminPhone,
            'address' =>  $request->adminAddress,
            'gender' =>  $request->adminGender,
            'updated_at' => Carbon::now(),
        ];
    }

    //user Validation Check
    private function userValidationCheck($request) {
        return  Validator::make($request->all(), [
            'adminName' => 'required',
            'adminEmail' => 'required',
        ],[
            'adminName.required' => 'Admin name is required',
            'adminEmail.required' => 'Admin email is required'
        ]);
    }

    //password validation check
    private function PasswordValidationCheck($request) {
        $validationRules = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|same:newPassword'
        ];

        $validationMessages = [
            'confirmPassword.same' => 'Confirm Password is not match with new password!',
        ];

        return Validator::make($request->all(),$validationRules,$validationMessages);
    }


}
