<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Love;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Http\Requests\AdminCreateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth', ['except'=>array('show')]);
    }
    public function show($slug)
    {
        $user = User::where('username', $slug)->first();
        $products = Product::where('user_id', $user->id)->paginate(10);
        $lovedProducts = Product::select('*', 'products.id')->join('love', 'products.id', '=', 'love.product_id')->where('love.user_id', $user->id)->where('love.loved', 1)->paginate(10);
        return view('users.show', compact(['user', 'products', 'lovedProducts']));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact(['user']));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->except(['_token','_method']);
        if ($request->hasFile('avatar')) {
            $imagePath = $request->avatar->store('avatar', 'uploads');
            $user->avatar_url = $imagePath;
        }
        $user->fill($input);
        $user->save();
        return redirect(route('home'));
    }

    public function destroy(Request $request)
    {
        if (Auth::user()->id == $request->id) {
            return response()->json(['error' => 'You cant delete your own account'], 403);
        }
        $user = User::findOrFail($request->id)->delete();
    }

    public function adminCreate()
    {
        $role = Role::all();
        return view('admins.user.create', compact(['role']));
    }
    public function adminStore(AdminCreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'gender' => $request['gender'],
        ]);
        if ($request->avatar) {
            $imagePath = $request->avatar->store('avatar', 'uploads');
            $user->avatar_url = $imagePath;
        }
        $user->syncRoles($request->role);
        $user->save();
        return redirect(route('admin.user'))->with('messenger', 'Create User Successed!!!');
    }

    public function adminEdit($id)
    {
        $user = User::findOrFail($id);
        $role = Role::all();
        return view('admins.user.edit', compact(['role','user']));
    }

    public function adminUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:20|unique:users,username,'.$id,
            'gender' =>'required|integer',
            'avatar' => 'image|mimes:jpeg,bmp,png|max:5120',
            ]);
        $input = $request->except(['_token','_method','role']);
        if ($request->avatar) {
            $imagePath = $request->avatar->store('avatar', 'uploads');
            $user->avatar_url = $imagePath;
        }
        $user->syncRoles($request->role);
        $user->fill($input);
        $user->save();
        return redirect(route('admin.user'))->with('messenger', 'Update User Successed!!!');
    }
    public function showChangePasswordForm()
    {
        return view('auth.changepassword');
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }
 
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }
 
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
 
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
 
        return redirect()->back()->with("success", "Password changed successfully !");
    }
}
