<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Massage;
use App\Models\Post;
use App\Models\PostAmount;
use App\Models\PostMassage;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MassageController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('user_login');
        }

        $userId = $request->query('user_id');
        $postId = $request->query('post_id');
        $amount = $request->query('amount');

        // Deleting any existing PostMassage records
        if ($postId) {
            $postMassage = PostMassage::where('to_id', $userId)
                ->where('from_id', Auth::id())
                ->where('post_id', $postId)
                ->first();

            if ($postMassage) {
                $postMassage->delete();
            }
            $sessionData = [
                'to_id' => (int) $userId,
                'from_id' => Auth::id(),
                'post_id' => (int) $postId,
            ];

            Session::put('postMassages', $sessionData);
        }

        if ($amount) {
            $postMassage = PostAmount::where('to_id', $userId)
                ->where('from_id', Auth::id())
                ->where('post_id', $postId)
                ->first();

            if ($postMassage) {
                $postMassage->delete();
            }
            $sessionAmountData = [
                'to_id' => (int) $userId,
                'from_id' => Auth::user()->id,
                'post_id' => (int) $postId,
                'amount' => (int) $amount,
            ];
            Session::put('postAmounts', $sessionAmountData);
        }

        // Creating a new PostMassage record


        // If userId is not provided, return the chat view with empty data
        if (empty($userId)) {

            return view('frontend.chat', ['massages' => [], 'userId' => [], 'postMassage' => null, 'user' => null, 'amount' => null]);
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


        $PostMassage = Session::get('postMassages');
        $PostAmount = Session::get('postAmounts');


        $user = User::find($userId);
        return view('frontend.chat', compact('massages', 'userId', 'PostMassage', 'user', 'PostAmount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'massage' => 'required',
        ]);
        $data = $request->all();
        Massage::create($data);
        return redirect()->back();
    }

    public function RemovePostMassage($id)
    {
        $post = PostMassage::find($id);
        if ($post) {
            $post->delete();
            Session::forget('postMassages');
            Session::forget('postAmounts');
        }
        return redirect()->route('home')->with('success', 'Post Sell Request Has been removed');
    }

    public function RelizeMassage($id)
    {
        $post = PostMassage::find($id);
        $posts = Post::find($post->post_id)->first();
        $posts->update([
            'relise_user' => $post->from_id,
            'status' => 0,
        ]);
        $post->delete();
        return redirect()->route('home')->with('success', 'Post Sell Request Has been Relise');
    }

    public function updateAmount(Request $request)
    {
        $userId = $request->to_id;
        $postId = $request->post_id;
        $amount = $request->amount;

        // Retrieve the data from the session
        $sessionPostMassage = Session::get('postMassages');
        $sessionPostAmount = Session::get('postAmounts');

        // Delete any existing postMassage record
        if ($sessionPostMassage) {
            PostMassage::where('to_id', $userId)
                ->where('from_id', Auth::id())
                ->where('post_id', $postId)
                ->delete();
        }

        // Create a new postMassage record
        PostMassage::create([
            'to_id' => (int) $userId,
            'from_id' => Auth::id(),
            'post_id' => (int) $postId,
        ]);

        // Delete any existing postAmount record
        if ($sessionPostAmount) {
            PostAmount::where('to_id', $userId)
                ->where('from_id', Auth::id())
                ->where('post_id', $postId)
                ->delete();
        }
        // Create a new postAmount record
        PostAmount::create([
            'to_id' => (int) $userId,
            'from_id' => Auth::user()->id,
            'post_id' => (int) $postId,
            'amount' => (int) $amount,
        ]);

        $post = PostMassage::find($postId);
        $posts = Post::find($postId);

        $posts->update([
            'relise_user' => Auth::user()->id,
            'status' => 2,
        ]);
        // Clear session data
        Session::forget('postMassages');
        Session::forget('postAmounts');

        return redirect()->route('home')->with('success', 'Post Massage and Amount updated successfully.');
    }

    public function moneyRequest(Request $request)
    {
        $saler_wallet = Wallet::where('user_id', $request->saler_id)->first();
        $user_wallet = Wallet::where('user_id', $request->user_id)->first();

        if ($user_wallet->wallet > $request->amount) {
            if ($saler_wallet) {
                $saler_wallet->wallet = ($saler_wallet->wallet + $request->amount);
                $saler_wallet->update();
            }
            if ($user_wallet) {
                $user_wallet->wallet = ($user_wallet->wallet - $request->amount);
                $user_wallet->update();
            }
            return redirect('/chat?user_id=' . $request->saler_id)->with('success', 'Process Completely Successfully');
        } else {
            return redirect('/chat?user_id=' . $request->saler_id)->with('fail', 'Your amount to low');
        }


    }
}
