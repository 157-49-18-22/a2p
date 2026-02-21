<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);

        return view('useraccounts.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('useraccounts.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email',
            'password' => 'required|confirmed',
            'role' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $role = Role::findorfail($request->input('role'));

            $user = User::create([
                'name' => ucwords($request->input('name')),
                'email' => $request->input('email'),
                'password' => '',
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'status' => $request->input('status'),
                'export' => $request->input('export'),
                'location' => $request->input('location'),
                'salary' => $request->input('salary'),
            ]);
            $user->setPasswordAttribute($request->input('password'));
            $user->assignRole($role);
            $user->saveQuietly();

            // handle image if its present
            if ($request->hasFile('photo')) {
				$image = $request->file('photo');
				//echo "<pre>";print_r($image);exit;
				$profile_photo = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/storage/galeryImages/');
				$image->move($destinationPath, $profile_photo);
				 $user->photo_url = $profile_photo;
                $user->saveQuietly();
				
				
				
                // $fileName = $request->file('photo')->getClientOriginalName();
                // $fileExtension = $request->file('photo')->getClientOriginalExtension();
                // $fileNameToStore = $fileName . '_' . $user->id . '_' . time() . '.' . $fileExtension;
                // $path = $request->file('photo')->storeAs('public/profile_picture', $fileNameToStore);
               
            }
            if ($request->hasFile('aadhar')) {
                $image = $request->file('aadhar');
				//echo "<pre>";print_r($image);exit;
				$aadhar = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/storage/galeryImages/');
				$image->move($destinationPath, $aadhar);
                $user->aadhar = $aadhar;
                $user->saveQuietly();
            }
            if ($request->hasFile('pancard')) {
                $image = $request->file('pancard');
				//echo "<pre>";print_r($image);exit;
				$pancard = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/storage/galeryImages/');
				$image->move($destinationPath, $pancard);
                $user->pancard = $pancard;
                $user->saveQuietly();
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'db_error' => $e->getMessage(),
            ]);
        }
        DB::commit();

        return redirect(route('useraccounts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findorfail($id);

        return view('useraccounts.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorfail($id);
        $roles = Role::all();

        return view('useraccounts.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email',
            //'password' => 'required|confirmed',
            'role' => 'required',
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
			
			DB::table('model_has_roles')->where('model_id', $id)->delete();
            $role = Role::findorfail($request->input('role'));
            $user = User::findorfail($id);
			
            $user->update([
                'name' => ucwords($request->input('name')),
                'email' => $request->input('email'),
                'status' => $request->input('status'),
                'export' => $request->input('export'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'salary' => $request->input('salary'),
                'location' => $request->input('location'),
                //'password' => '',
				'incentive_percentage' => $request->input('incentive_percentage'),
            ]);
            //$user->setPasswordAttribute($request->input('password'));
            $user->assignRole($role);
            $user->saveQuietly();

            // handle image if its present
            if ($request->hasFile('photo')) {
                // delete old photo if present
                if($user->photo_url !== null) {
                    $file_path = public_path('/storage/galeryImages/' . $user->photo_url);
                    @unlink($file_path);
                }

                // now add new photo
                $image = $request->file('photo');
				//echo "<pre>";print_r($image->getClientOriginalName());exit;
				$profile_photo = $image->getClientOriginalName();
				$destinationPath = public_path('/storage/galeryImages/');
				$image->move($destinationPath, $profile_photo);
				 $user->photo_url = $profile_photo;
                $user->saveQuietly();
            }
			if ($request->hasFile('aadhar')) {
                // delete old photo if present
                if($user->aadhar !== null) {
                    $file_path = public_path('/storage/galeryImages/' . $user->aadhar);
                    @unlink($file_path);
                }

                // now add new photo
                $image = $request->file('aadhar');
				//echo "<pre>";print_r($image);exit;
				$aadhar = $image->getClientOriginalName();
				$destinationPath = public_path('/storage/galeryImages/');
				$image->move($destinationPath, $aadhar);
				 $user->aadhar = $aadhar;
                $user->saveQuietly();
            }
			if ($request->hasFile('pancard')) {
                // delete old photo if present
                if($user->pancard !== null) {
                    $file_path = public_path('/storage/galeryImages/' . $user->pancard);
                    @unlink($file_path);
                }

                // now add new photo
                $image = $request->file('pancard');
				//echo "<pre>";print_r($image);exit;
				$pancard = $image->getClientOriginalName();
				$destinationPath = public_path('/storage/galeryImages/');
				$image->move($destinationPath, $pancard);
				$user->pancard = $pancard;
                $user->saveQuietly();
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'db_error' => $e->getMessage(),
            ]);
        }
        DB::commit();

        return redirect(route('useraccounts.index'));
    }
 public function update_password(Request $request, $id)
    {
        $this->validate($request, [
			'password' => 'required|confirmed',
        ]);

        DB::beginTransaction();
        try {			
            $user = User::findorfail($id);
            $user->setPasswordAttribute($request->input('password'));
            $user->saveQuietly();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'db_error' => $e->getMessage(),
            ]);
        }
        DB::commit();

        return redirect(route('useraccounts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findorfail($id);
        //$user->deletedBy()->associate(auth()->user());
       // $user->saveQuietly();
        $user->forceDelete();

        return back();
    }
}
