<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodType;
use App\Models\Wallet;
use App\Models\WalletHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function depositIndex()
    {
        $deposits = WalletHistory::where('user_id', Auth::user()->id)->where('for', 'deposit')->get();
        return view('frontend.dashboard.deposit.index', compact('deposits'));
    }
    public function addDeposit()
    {
        $payment_method_types = PaymentMethodType::latest()->with('payment_methods')->get();
        $payment_methods = PaymentMethod::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('frontend.dashboard.deposit.add1', compact('payment_methods', 'payment_method_types'));
    }
    public function addDeposit2($id)
    {
        $payment = PaymentMethod::find($id);
        return view('frontend.dashboard.deposit.add2', compact('payment'));
    }
    public function depositStore(Request $request)
    {
        // return $request->all();
        $request->validate([
            'gateway' => 'required',
            'full_amount' => 'required',
        ]);
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id', $user_id)->first();
        if ($wallet) {
            $wallet->update([
                'deposit' => $wallet->deposit + $request->full_amount,
            ]);
        } else {
            Wallet::create([
                'user_id' => $user_id,
                'deposit' => $request->full_amount,
                'withdrow' => 0,
                'total' => 0,
            ]);
        }
        $wallet = Wallet::where('user_id', $user_id)->first();
        WalletHistory::create([
            'user_id' => Auth::user()->id,
            'wallet_id' => $wallet->id,
            'for' => 'deposit',
            'gateway' => $request->gateway,
            'subject' => 'Add Request Deposit',
            'to_number' => $request->number,
            'from_number' => $request->from_number,
            'desc' => $request->desc,
            'tranjection' => $request->tranjection,
            'change_amount' => $request->full_amount,
            'status' => 0,
        ]);
        return redirect()->route('deposit_all')->with('success', "Add Deposit Request Successfully");
    }
    public function DepositDelete($id)
    {
        $walletHistory = WalletHistory::find($id);
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();
        $wallet->update([
            'deposit' => $wallet->deposit - $walletHistory->change_amount,
        ]);
        $walletHistory->delete();
        return redirect()->route('deposit_all')->with('success', " Deposit Request Deleted Successfully");
    }

    public function withdrowIndex()
    {
        $withdrows = WalletHistory::where('user_id', Auth::user()->id)->where('for', 'withdrow')->get();
        return view('frontend.dashboard.withdrow.index', compact('withdrows'));
    }
    public function addwithdrow()
    {
        $payment_methods = PaymentMethod::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('frontend.dashboard.withdrow.add1', compact('payment_methods'));
    }
    public function addwithdrow2($id)
    {
        $payment = PaymentMethod::find($id);
        return view('frontend.dashboard.withdrow.add2', compact('payment'));
    }
    public function withdrowStore(Request $request)
    {
        $request->validate([
            'gateway' => 'required',
            'change_amount' => 'required',
        ]);
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id', $user_id)->first();
        if ($wallet) {
            $wallet->update([
                'withdrow' => $wallet->withdrow + $request->change_amount,
                'wallet' => $wallet->wallet - $request->change_amount,
            ]);
        } else {
            Wallet::create([
                'user_id' => $user_id,
                'withdrow' => 0,
                'withdrow' => $request->change_amount,
                'total' => 0,
            ]);
        }
        $wallet = Wallet::where('user_id', $user_id)->first();
        WalletHistory::create([
            'user_id' => Auth::user()->id,
            'wallet_id' => $wallet->id,
            'for' => 'withdrow',
            'gateway' => $request->gateway,
            'number' => $request->number,
            'subject' => 'Add Request Withdrow',
            'desc' => $request->desc,
            'tranjection' => $request->tranjection,
            'change_amount' => $request->change_amount,
            'status' => 0,
        ]);
        return redirect()->route('withdrow_all')->with('success', "Add Withdrow Request Successfully");
    }
    public function WithdrowDelete($id)
    {
        $walletHistory = WalletHistory::find($id);
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();
        $wallet->update([
            'withdrow' => $wallet->change_amount,
        ]);
        $walletHistory->delete();
        return redirect()->route('withdrow_all')->with('success', " Withdrow Request Deleted Successfully");
    }


    public function Payment($id)
    {
        $payment = PaymentMethod::where('name', $id)->first();
        return response()->json([
            'number' => $payment->account_no,
            'image' => $payment->image,
        ]);
    }
}
