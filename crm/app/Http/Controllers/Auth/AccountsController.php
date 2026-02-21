<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Support\Facades\DB;


use App\Models\User;

class AccountsController extends Controller
{
    protected $redirectTo = '/';

    public function index()
    {
        // If the users table is empty then redirect
        // to the signup page.
        $users = User::all();
        if (count($users) < 1) {
            return redirect()->route('signup.index');
        }

        return view('signin.index');
    }

    public function signin(Request $request)
    {
        $request->flashExcept('password');

        $credentials = $request->only('email', 'password');

        $remember = false;

        if ($request->has('remember')) {
            $remember = true;
        }
		
        if (Auth::attempt($credentials, $remember)) {
			
            $request->session()->regenerate();
			$role = Auth::user()->roles->pluck('name');
			$user = User::findorfail(Auth::user()->id);
			$code = rand(100000,999999);
			$insert_update  = DB::table('user_codes')
				->updateOrInsert(
					['user_id' => Auth::user()->id],
					['code' => $code]
				);
			$user = User::findorfail(Auth::user()->id);
			if($user->id != 1 && $user->status !=0){
				 $info = array(
					'name' => $user->name,
					'code' => $code
				);
				Mail::send( 'mail', $info, function ($message)
				{
					$message->to(Auth::user()->email, 'A2P Realtech Pvt. Ltd.')
					//$message->to('nisharawat783@gmail.com', 'A2P Realtech Pvt. Ltd.')
						->subject('2 Factor Authentication for A2P Realtech Pvt. Ltd.');
					$message->from('a2prealtechpvtltd@gmail.com', 'A2P Realtech Pvt. Ltd.');
				});
				return redirect()->intended('/account/2fa');
			}elseif( $user->status == 0){
				echo "Your account is deactivated, Please contact admin ";exit;
				
			}else{
				return redirect()->intended('/');
			}
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function signout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('signin.index');
    }

    public function myAccount()
    {
        return view('myaccount.index');
    }

    public function updateMyPersonalDetails(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email',
            'photo' => 'image|max:1999',
        ]);

        $user = User::findorfail($id);

        $user->update([
            'name' => ucwords($request->input('name')),
            'email' => $request->input('email'),
        ]);

        // handle image if its present
        if ($request->hasFile('photo')) {
            // delete old photo if present
            if($user->photo_url !== null) {
                $file_path = public_path('storage/profile_picture/' . $user->photo_url);
                @unlink($file_path);
            }

            // now add new photo
            $fileName = $request->file('photo')->getClientOriginalName();
            $fileExtension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . $user->id . '_' . time() . '.' . $fileExtension;
            $path = $request->file('photo')->storeAs('public/profile_picture', $fileNameToStore);
            $user->photo_url = $fileNameToStore;
            $user->saveQuietly();
        }

        return back()->with('success', 'You have successfully changed your personal details.');
    }

    public function changeMyPassword(Request $request, $id)
    {
        $this->validate($request, [
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed',
        ]);
		$code = rand(100000,999999);
		$code_admin = rand(100000,999999);
		$insert_update  = DB::table('user_codes')
			->updateOrInsert(
				['user_id' => Auth::user()->id],
				['code' => $code,'admin_code'=>$code_admin]
			);
        $user = User::findorfail($id);
        /* */
		$info = array(
					'name' => $user->name,
					'code' => $code
				);
		$info_1 = array(
					'name' => 'Admin',
					'username' => $user->name,
					'code' => $code_admin
				);
		Mail::send( 'mail_password', $info, function ($message)
		{
			$message->to(Auth::user()->email, 'A2P Realtech Pvt. Ltd.')
				->subject('2 Factor Authentication for change password');
			$message->from('a2prealtechpvtltd@gmail.com', 'A2P Realtech Pvt. Ltd.');
		});
		/* $admin = User::findorfail(1);
		$a_email= $admin->email; */
		Mail::send( 'mail_password_admin', $info_1, function ($message)
		{
			$message->to('adminrealtech@yopmail.com', 'A2P Realtech Pvt. Ltd.')
				->subject('2 Factor Authentication for change password');
			$message->from('a2prealtechpvtltd@gmail.com', 'A2P Realtech Pvt. Ltd.');
		});
		$password= $request->password;
		return view('myaccount.2fa', compact('password'));


       // return back()->with('success', 'You have successfully changed your password.');
    }
	 public function two_factor_auth(Request $request)
    {
        if($request->code){
			$data = DB::select('select * from user_codes where user_id ="'.Auth::user()->id.'" and code = "'.$request->code.'"');
			if($data){
				return redirect()->intended('/');
			}else{
				return back()->withErrors([
					'code' => 'The provided verification code do not match our records.',
				]);
			}
		}
		
        return view('signin.2fa');
    }
	 public function two_factor_auth_pwd(Request $request)
    {
        if($request->code && $request->admin_code){
			$data = DB::select('select * from user_codes where user_id ="'.Auth::user()->id.'" and code = "'.$request->code.'" and admin_code ="'.$request->admin_code.'"');
			if($data){
				//echo "<pre>";print_r($request->input('password'));exit;
				$user = User::findorfail(Auth::user()->id);
				$user->setPasswordAttribute($request->input('password'));
				$user->save();
				$insert_update  = DB::table('notifications')
				->updateOrInsert(
					['user_id' => Auth::user()->id],
					['notification_text' => "Your Password has been changed successfully",'status'=>0]
				);
				$user = User::findorfail(Auth::user()->id);
				$insert_update  = DB::table('notifications')
				->updateOrInsert(
					['user_id' => 1],
					['notification_text' => $user->name ." has changed password successfully",'status'=>0]
				);
				//echo "<pre>";print_r($user->save());exit;
				  return view('myaccount.index');
			}else{
				return back()->withErrors([
					'code' => 'The provided verification code do not match our records.',
				]);
			}
		}
		
        return view('myaccount.2fa');
    } 
	public function notification(Request $request)
    {
		//echo $request->mark_read;exit;
		if(isset($request->mark_read)){
			//echo Auth::user()->id;exit;
			$update = DB::table('notifications')
				->where('user_id' , Auth::user()->id)
				->update(['status'=>1]);
		}
        $notifications = DB::select('SELECT * FROM notifications where status = 0 and   user_id = "'.Auth::user()->id.'" Order by id desc');
        return view('myaccount.navbar-notification', compact('notifications'));
    }
	public function send_notification(Request $request)
    {
		$user =user::findorfail(auth()->user()->id);
		$notification =$request->notification;
		//echo "<pre>";print_r($notification['text']);exit;
		$insert_update  = DB::table('notifications')
				->Insert(
					['user_id' => 1,'notification_text' => 'New Notification "'.$notification['text']. '" has been sent  by '.$user->name,"status"=>0],
				);
        $notifications = DB::select('SELECT * FROM notifications where status = 0 and   user_id = "'.Auth::user()->id.'" Order by id desc');
        return view('myaccount.navbar-notification', compact('notifications'));
    }
}
