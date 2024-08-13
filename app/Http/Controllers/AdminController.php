<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletHistory;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    } // End Mehtod


    public function AdminDashboard()
    {
        $user = User::where('role', 'user')->get();
        $total_user = count($user);
        $post = Post::get();
        $total_post = count($post);
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();

        $total_balance = Wallet::sum('wallet');
        $deposits = WalletHistory::where('for', 'deposit')->orderBy('id', 'DESC')->where('status', 0)->count();

        $withdrows = WalletHistory::where('for', 'withdrow')->orderBy('id', 'DESC')->where('status', 0)->count();
        return view('admin.index', compact('total_user', 'total_post', 'wallet', 'total_balance', 'withdrows', 'deposits'));
    } // End Method


    public function AdminLogout(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'info'

        );

        return redirect()->route('home');
    } // End Method

    public function AdminLogin()
    {
        $personal = Personal::first();
        return view('admin.admin_login', compact('personal'));
    } // End Method

    public function AdminLogoutPage()
    {
        return view('admin.admin_logout');
    } // End Method

    public function AdminProfile()
    {

        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    } // End Method


    public function AdminProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);
    } // End Method


    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    } // End Method

    public function AdminUpdatePassword(Request $request)
    {

        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with('error', "Old Password Doesn't Match!!");
        }
        // Update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('status', "Password Change Successfully");
    } // End Method

    public function AllAdmin()
    {

        $alladminuser = User::where('role', 'admin')->latest()->get();
        return view('backend.admin.all_admin', compact('alladminuser'));
    } // End Method

    public function AddAdmin()
    {
        return view('backend.admin.add_admin');
    } // End Method

    public function StoreAdmin(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->unique_id = random_int(100000, 999999);

        $user->status = 1;
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }
        $notification = array(
            'message' => 'New Admin User Created Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);
    } // End Method

    public function EditAdmin($id)
    {
        $adminuser = User::findOrFail($id);
        return view('backend.admin.edit_admin', compact('adminuser'));
    } // End Method



    public function UpdateAdmin(Request $request)
    {

        $admin_id = $request->id;

        $user = User::findOrFail($admin_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = 'admin';
        $user->status = 1;
        $user->save();
        $user->roles()->detach();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }
        $notification = array(
            'message' => 'Admin User Updated Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);
    } // End Method


    public function DeleteAdmin($id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
    } // End Mehtod

    public function InactiveAdminUser($id)
    {

        User::findOrFail($id)->update(['status' => 'inactive']);

        $notification = array(
            'message' => 'Admin User Inactive',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
    } // End Mehtod


    public function ActiveAdminUser($id)
    {

        User::findOrFail($id)->update(['status' => 'active']);

        $notification = array(
            'message' => 'Admin User Active',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
    } // End Mehtod





}
