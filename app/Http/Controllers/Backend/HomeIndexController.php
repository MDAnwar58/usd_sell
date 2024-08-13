<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Connect;
use App\Models\ContactMassage;
use App\Models\Massage;
use App\Models\Notification;
use App\Models\Post;
use App\Models\PostMassage;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeIndexController extends Controller
{
    public function ContactMassage()
    {
        return view('backend.contact_massage.index', [
            'messages' => ContactMassage::orderBy('id', 'DESC')->get(),
        ]);
    }


    public function Massageindex(Request $request)
    {

        $authUserId = Auth::user()->id;
        $userId = $request->query('user_id');



        if (empty($userId)) {

            return view('backend.massage.index', ['massages' => [], 'userId' => [], 'postMassage' => null, 'user' => null]);
        }

        $authUserId = Auth::id();

        // Get all messages between the authenticated user and the specified user
        $massages = Massage::where(function ($query) use ($authUserId, $userId) {
            $query->where(function ($subQuery) use ($authUserId, $userId) {
                $subQuery->where('from_id', $authUserId)
                    ->where('to_id', $userId);
            })->orWhere(function ($subQuery) use ($authUserId, $userId) {
                $subQuery->where('from_id', $userId)
                    ->where('to_id', $authUserId);
            });
        })->with('fromUser', 'toUser')->orderBy('id', 'ASC')->get();

               $user = User::find($userId);
        return view('backend.massage.index', compact('massages', 'userId', 'user'));
    }
    public function Massagestore(Request $request)
    {
        $request->validate([
            'massage' => 'required',
        ]);
        $data = $request->all();
        Massage::create($data);
        return redirect()->back();
    }

    public function User()
    {
        $users = User::where('role', 'user')->with('wallet')->get();
        return view('backend.user.index', compact('users'));
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        $walletHistory = WalletHistory::where('user_id', $id)->get();
        foreach ($walletHistory as $item) {
            $item->delete();
        }
        $massage = Massage::where('to_id', $id)->orWhere('from_id', $id)->get();
        foreach ($massage as $item) {
            $item->delete();
        }
        $posts = Post::where('user_id', $id)->get();
        foreach ($posts as $item) {
            $item->delete();
        }
        $notifications = Notification::where('to_id', $id)->orWhere('from_id', $id)->get();
        foreach ($notifications as $item) {
            $item->delete();
        }
        $notifications = PostMassage::where('to_id', $id)->orWhere('from_id', $id)->get();
        foreach ($notifications as $item) {
            $item->delete();
        }
        $connects = Connect::where('to_id', $id)->orWhere('from_id', $id)->get();
        foreach ($connects as $item) {
            $item->delete();
        }

        $admin = User::where('role', 'admin')->first();
        $user_wallet = Wallet::where('user_id', $id)->first();
        if ($user_wallet) {
            $wallet = Wallet::where('user_id', $admin->id)->first();
            if ($wallet) {
                $wallet->update([
                    'wallet' => $wallet->wallet ?? 0 + $user_wallet->wallet ?? 0,
                ]);
            } else {
                Wallet::create([
                    'user_id' => $admin->id,
                    'wallet' => $user_wallet->wallet ?? 0,
                    'deposit' => 0,
                    'withdrow' => 0,
                ]);
            }

            $user_wallet->delete();
        }
        $user->delete();
        Notification::create([
            'to_id' => $admin->id,
            'from_id' => $admin->id,
            'massage' => 'Delete  A User',
        ]);
        return redirect()->back()->with('success', 'Successfully Deleted User');
    }
}
