<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.layout.dashboard.home');
    }

    public function getRegister(){
        return view('admin.layout.register');
    }

    public function postRegister(Request $request){
        $this -> validate($request , [
            'username' => 'required|min:5|unique:users,username',
            'password' => 'required',
            'confirn_password' => 'required|same:password'
        ] , [
            'username.required' => 'Vui lòng nhập tên tài khoản admin !',
            'username.min' => 'Tên tài khoản admin ít nhất 5 kí tự !',
            'username.unique' => 'Tên tài khoản admin đã tồn tại !',
            'password.required' => 'Vui lòng nhập mật khẩu !',
            'confirn_password.required' => 'Vui lòng nhập lại mật khẩu !',
            'confirn_password.same' => 'Mật khẩu nhập lại không khớp !'
        ]);

        $admin = new User();
        $admin['username'] = $request['username'];
        $admin['email'] = $request['email'];
        $admin['password'] = bcrypt($request['password']);
        $admin['level'] = $request['level'];
        $admin -> save();

        return redirect()->route('login');
    }

    public function getLogin(){
        return view('admin.layout.login');
    }

    public function postLogin(Request $request){
        $username = $request->username;
		$password = $request->password;

        if(Auth::attempt(['username' => $username , 'password' => $password])){
            return redirect()->route('dashboard');
        }
        else{
            return back()->with('error','Tài khoản hoặc mật khẩu không chính xác !');
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function getProfile()
    {
    	$profile = User::find(Auth::user()->id);
    	return view('admin.layout.users.profile',['profile'=>$profile]);
    }

    public function postProfileUpdate(Request $request){
        $profile = User::find(Auth::user()->id);

        $this -> validate($request,[
            'facebook' => 'required|min:3|max:70',
            'fullname' => 'required|min:3|max:30',
            'age' => 'required'
        ],[
            'facebook.required' => 'Vui lòng nhập Facebook',
            'facebook.min'=>'Facebook gồm ít nhất 3 ký tự!',
            'facebook.max'=>'Facebook gồm tối đa 70 ký tự!',
            'fullname.required' => 'Vui lòng nhập Họ tên',
            'fullname.min'=>'Họ tên ít nhất 3 ký tự!',
            'fullname.max'=>'Họ tên tối đa 30 ký tự!',
            'age.required' => 'Vui lòng chọn trạng thái'
        ]);

        if($request -> hasFile('avatar')){
            $file = $request -> file('avatar');
            $fileType = $file -> getClientOriginalExtension('avatar');
            if($fileType == "jpg" || $fileType == 'png' || $fileType == 'jpeg'){

                $AvatarName = 'avatar_'.rand().'.'.$fileType;
                $file -> move('admin/images/avatar',$AvatarName);
                $urlAvatar = 'admin/images/avatar/'.$AvatarName;

                $profile->facebook = $request->input('facebook');
                $profile->age = $request->input('age');
                $profile->fullname = $request->input('fullname');
                $profile->avatar = $urlAvatar;

                $profile -> save();

                return redirect()->route('profile')->with('success', 'Chỉnh sửa thông tin cá nhân thành công.');

            }
            else{
                return back()->with("error","Phải là file ảnh (jpg , png ,jpeg)");
            }
        }
        else{
            return back()->with("error","Bạn chưa chọn ảnh");
        }
    }

    public function showChangePasswordGet() {
        return view('admin.layout.users.changepass');
    }

    public function changePasswordPost(Request $request) {

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            return back()->with("error","Mật khẩu của bạn không đúng");
        }

        if(strcmp($request->get('current_password'), $request->get('password')) == 0){
            // Current password and new password same
            return back()->with("error","Mật khẩu mới không được giống mật khẩu cũ");
        }

        $this -> validate($request,[
            'current_password' => 'required',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password'
        ],[
            'current_password.required' => 'Vui lòng nhập mật khẩu',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password_confirmation.required' => 'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu mới gồm ít nhất 6 ký tự!',
            'password_confirmation.same' => 'Mật khẩu nhập lại không khớp !'
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Thay đổi mật khẩu thành công !');
    }
}
