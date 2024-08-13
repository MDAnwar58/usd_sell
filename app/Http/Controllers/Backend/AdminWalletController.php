<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminWalletController extends Controller
{
    public function DepositList()
    {
        $deposits = WalletHistory::where('for', 'deposit')->orderBy('id', 'DESC')->where('status', 0)->get();
        return view('backend.request.deposit', compact('deposits'));
    }
    public function AcceptDeposit($id)
    {
        $deposit = WalletHistory::find($id);
        $wallet = Wallet::where('user_id', $deposit->user_id)->first();

        $method = PaymentMethod::where('name', $deposit->gateway)->first();
        $charge = ($deposit->change_amount * $method->commission) / 100;


        $admin = User::where('role', 'admin')->first();
        $admin_wallet = Wallet::where('user_id', $admin->id)->first();
        $admin_wallet->update([
            'wallet' => $admin_wallet->wallet + $charge
        ]);
        $wallet->update([
            'wallet' => $wallet->wallet + ($deposit->change_amount - $charge),
            'deposit' => $wallet->deposit - $deposit->change_amount,
        ]);
        $deposit->update([
            'status' => 1,
            'subject' => 'Success Deposit'
        ]);
        Notification::create([
            'to_id' => $deposit->user_id,
            'from_id' => Auth::user()->id,
            'massage' => 'Your Deposit Request Approve Successfully',
        ]);
        $notification = array(
            'message' => 'Admin Accepted Successfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
    }
    public function DestroyDeposit($id)
    {
        $deposit = WalletHistory::find($id);
        $wallet = Wallet::where('user_id', $deposit->user_id)->first();
        $wallet->update([
            'deposit' => $wallet->deposit - $deposit->change_amount,
        ]);
        $deposit->delete();
        Notification::create([
            'to_id' => $deposit->user_id,
            'from_id' => Auth::user()->id,
            'massage' => 'Your Deposit Request Rejected and Deleted',
        ]);
        $notification = array(
            'message' => 'Deposit Deleted Successfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
    }

    public function WithdrowList()
    {
        $withdrows = WalletHistory::where('for', 'withdrow')->orderBy('id', 'DESC')->where('status', 0)->get();
        return view('backend.request.withdrow', compact('withdrows'));
    }
    public function AcceptWithdrow($id)
    {
        $withdrow = WalletHistory::find($id);
        $wallet = Wallet::where('user_id', $withdrow->user_id)->first();
        $wallet->update([
            'withdrow' => $wallet->withdrow - $withdrow->change_amount,
        ]);
        $withdrow->update([
            'status' => 1,
            'subject' => 'Success Withdrow'
        ]);
        Notification::create([
            'to_id' => $withdrow->user_id,
            'from_id' => Auth::user()->id,
            'massage' => 'Your Withdrow Request Approve Successfully',
        ]);
        return redirect()->back()->with('success', 'Withdrow Accept Successfully');
    }
    public function DestroyWithdrow($id)
    {
        $withdrow = WalletHistory::find($id);
        $wallet = Wallet::where('user_id', $withdrow->user_id)->first();
        $wallet->update([
            'wallet' => $wallet->wallet - $withdrow->change_amount,
            'withdrow' => $wallet->withdrow - $withdrow->change_amount,
        ]);
        $withdrow->delete();
        Notification::create([
            'to_id' => $withdrow->user_id,
            'from_id' => Auth::user()->id,
            'massage' => 'Your Withdrow Request Rejected and Deleted',
        ]);
        return redirect()->back()->with('success', 'Withdrow Deleted Successfully');
    }
}
