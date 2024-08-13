<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ActiveLanguage;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App;
use App\Models\AboutUs;
use App\Models\Banner;
use App\Models\Connect;
use App\Models\ContactMassage;
use App\Models\Country;
use App\Models\Massage;
use App\Models\Notification;
use App\Models\PaymentMethod;
use App\Models\Personal;
use App\Models\Post;
use App\Models\Privacy;
use App\Models\Tarms;
use App\Models\User;
use App\Models\UserPayment;
use App\Models\WalletHistory;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function index()
    {

        return view('frontend.home.index', [
            'user' => Auth::user(),
            'personal' => Personal::first(),
        ]);
    }

    public function login()
    {

        $countries = Country::get();
        $currency = PaymentMethod::where('status', 1)->get();
        return view('frontend.auth.login', compact('countries', 'currency'));
    }
    public function registration()
    {

        $countries = Country::get();
        $currency = PaymentMethod::where('status', 1)->get();
        return view('frontend.auth.register', compact('countries', 'currency'));
    }
    public function allPost(Request $request)
    {
        $categories = Category::all();

        $postsQuery = Post::where('status', 1);

        if ($request->filled('category_id')) {
            $postsQuery->where('category_id', $request->category_id);
        }

        if (Auth::check()) {
            $postsQuery->where('user_id', '!=', Auth::id());
        }

        $posts = $postsQuery->orderBy('id', 'DESC')->get();

        return view('frontend.p2p.index', compact('categories', 'posts'));
    }


    public function sellPost(Request $request)
    {
        $banners = Banner::where('status', 1)->get();
        $categories = Category::all();

        $postsQuery = Post::where('status', 1);

        if ($request->filled('category_id')) {
            $postsQuery->where('category_id', $request->category_id);
        }

        if (Auth::check()) {
            $postsQuery->where('user_id', '!=', Auth::id());
        }

        $posts = $postsQuery->orderBy('id', 'DESC')->where('for', 'sell')->get();

        return view('frontend.p2p.sell', compact('categories', 'posts'));
    } // End Method

    public function yourPost()
    {
        if (!Auth::user()) {
            return redirect()->route('user_login');
        }
        $posts = Post::where('user_id', Auth::user()->id)->with('category')->orderBy('id', 'DESC')->get();
        return view('frontend.ads.index', compact('posts'));
    } // End Method
    public function buyPost(Request $request)
    {

        $banners = Banner::where('status', 1)->get();
        $categories = Category::all();

        $postsQuery = Post::where('status', 1);

        if ($request->filled('category_id')) {
            $postsQuery->where('category_id', $request->category_id);
        }

        if (Auth::check()) {
            $postsQuery->where('user_id', '!=', Auth::id());
        }

        $posts = $postsQuery->orderBy('id', 'DESC')->where('for', 'buy')->get();

        return view('frontend.p2p.buy', compact('categories', 'posts'));
    } // End Method

    public function addPost()
    {
        $categories = Category::get();
        $gateway = PaymentMethod::get();
        return view('frontend.ads.add', compact('categories', 'gateway'));
    } // End Method

    public function SellStore(Request $request)
    {
        $request->validate([
            'for' => 'required',
            'category_id' => 'required',
            'quality' => 'required',
            'contact_number' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['limit'] = $request->to_limit . "-" . $request->from_limit;
        $data['status'] = '1';

        Post::create($data);

        $connects = Connect::where('to_id', Auth::user()->id)->orWhere('from_id', Auth::user()->id)->get();
        if ($connects) {
            foreach ($connects as $item) {
                if ($item->to_id == Auth::user()->id) {
                    Notification::create([
                        'to_id' => $request->from_id,
                        'from_id' => Auth::user()->id,
                        'massage' => 'Add a new Post',
                        'status' => 0,
                    ]);
                } else {
                    Notification::create([
                        'to_id' => $item->to_id,
                        'from_id' => Auth::user()->id,
                        'massage' => 'Add a new post',
                        'status' => 0,
                    ]);
                }
            }
        }

        return redirect()->route('your_post')->with('success', 'Post Create Sucessfully');
    }

    public function search(Request $request)
    {
        $unique_id = $request->unique_id;

        // Search for the user by unique_id or name
        $user = User::with(['receivedConnections', 'sentConnections'])
            ->where('unique_id', $unique_id)
            ->orWhere('name', 'like', '%' . $request->unique_id . '%')
            ->first();

        // Initialize default values
        $totalConnections = 0;
        $isConnected = false;

        if (Auth::check()) {
            $authUserId = Auth::id();

            // If user is found, check for connections
            if ($user) {
                $userId = $user->id;

                // Check if there's a connection where the authenticated user is either the sender or the recipient
                $connection = Connect::where(function ($query) use ($authUserId, $userId) {
                    $query->where('from_id', $authUserId)->where('to_id', $userId);
                })->orWhere(function ($query) use ($authUserId, $userId) {
                    $query->where('to_id', $authUserId)->where('from_id', $userId);
                })->first();

                // Determine if the user is connected
                $isConnected = $connection !== null;

                // Count the total connections
                $totalConnections = $user->receivedConnections->count() + $user->sentConnections->count();
            }
        }

        // Get the latest post ID
        $post = Post::orderBy('id', 'DESC')->first();
        $post_id = $post ? $post->id : null;

        if ($user) {
            return view('frontend.profile', compact('user', 'post_id', 'totalConnections', 'isConnected'));
        } else {
            return view('frontend.404');
        }
    }


    public function UserProfile($id)
    {
        $user = User::with(['receivedConnections', 'sentConnections'])->where('id', $id)->first();
        if (Auth::user()) {
            $authUserId = Auth::id();
            // Check if there's a connection where the authenticated user is either the sender or the recipient
            $connection = Connect::where(function ($query) use ($authUserId, $id) {
                $query->where('from_id', $authUserId)->where('to_id', $id);
            })->orWhere(function ($query) use ($authUserId, $id) {
                $query->where('to_id', $authUserId)->where('from_id', $id);
            })->first();

            // Determine if the user is connected
            $isConnected = $connection !== null;

            // Count the total connections
            $totalConnections = $user->receivedConnections->count() + $user->sentConnections->count();
        } else {
            $totalConnections = 0;
            $isConnected = null;
        }

        if ($user) {
            return view('frontend.profile', compact('user', 'totalConnections', 'isConnected'));
        } else {
            return view('frontend.404');
        }
    }
    public function SellUpdate(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post->user_id == Auth::user()->id) {
            $data = $request->all();
            $post->update($data);
            return redirect()->route('home')->with('success', 'Post Create Sucessfully');
        } else {
            return redirect()->back()->with('error', 'Permision not have');
        }
    }


    public function Notifications()
    {
        $notifications = Notification::where('to_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.notification', compact('notifications'));
    }
    public function Tranjections()
    {
        $tranjections = WalletHistory::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.dashboard.tranjection', compact('tranjections'));
    }
    public function ReadNotification($id)
    {
        $notification = Notification::find($id);
        $notification->update(['status' => 1]);
        if ($notification->massage == 'Send a Friend Request') {
            return redirect()->route('profile', [
                'user' => User::find($notification->from_id),
            ]);
        }
        return redirect()->back();
    }
    public function UnreadAll()
    {
        $notification = Notification::where('to_id', Auth::user()->id)->where('status', 0)->get();
        foreach ($notification as $item) {
            $item->update(['status', 1]);
        }
        return redirect()->back();
    }


    public function sellDelete($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->back()->with('success', 'Post Deleted Successfully');
    }
    public function sell()
    {
        if (Auth::user() == null) {
            return view('frontend.auth.login');
        }

        $categories = Category::get();
        $sells = Post::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.sell', compact('categories', 'sells'));
    } // End Method
    public function addSell()
    {
        if (Auth::user() == null) {
            return view('frontend.login');
        }
        $categories = Category::get();
        $methods = PaymentMethod::where('status', 1)->get();
        $sells = Post::where('user_id', Auth::user()->id)->get();
        return view('frontend.ads.add', compact('categories', 'sells', 'methods'));
    } // End Method

    public function sellEdit($id)
    {

        $categories = Category::get();

        $post = Post::find($id);
        $gateway = PaymentMethod::where('status', 1)->get();

        return view('frontend.ads.edit', compact('categories', 'post', 'gateway'));
    } // End Method
    public function sellBlock($id)
    {
        $sell = Post::find($id);
        $sell->update([
            'status' => '2'
        ]);
        return redirect()->back()->with('success', 'Post Deleted Successfully');
    } // End Method

    public function contact()
    {
        return view('frontend.contact');
    }
    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);
        ContactMassage::create($request->all());
        return redirect()->back()->with('success', 'Massage Send Successfully');
    }
    public function about()
    {
        $about = AboutUs::first();
        return view('frontend.about_us', compact('about'));
    }
    public function privacy()
    {
        $privacy = Privacy::first();
        return view('frontend.privacy', compact('privacy'));
    }
    public function terms()
    {
        $terms = Tarms::first();
        return view('frontend.terms', compact('terms'));
    }
    public function connect($userId)
    {
        $authUserId = Auth::id();

        // Create a new connection
        Connect::create([
            'from_id' => $authUserId,
            'to_id' => $userId
        ]);

        // Create a new notification
        Notification::create([
            'to_id' => $userId,
            'from_id' => $authUserId,
            'massage' => 'Send a Friend Request',
            'status' => 0,
        ]);

        return redirect()->route('profile', $userId)->with('success', 'Send a request for Connect');
    }

    public function DisConnect($userId)
    {
        $authUserId = Auth::id();

        // Delete the connection
        $connect = Connect::where(function ($query) use ($authUserId, $userId) {
            $query->where('from_id', $authUserId)->where('to_id', $userId);
        })->orWhere(function ($query) use ($authUserId, $userId) {
            $query->where('to_id', $authUserId)->where('from_id', $userId);
        })->first();

        Notification::create([
            'to_id' => $connect->to_id,
            'from_id' => Auth::user()->id,
            'massage' => 'Discount Friend',
            'status' => 0,
        ]);
        $connect->delect();
        return back()->with('success', 'Disconnect Friend');
    }

    public function PaymentIndex()
    {
        $payment = UserPayment::where('user_id', Auth::user()->id)->first();
        return view('frontend.dashboard.payment', compact('payment'));
    }

    public function PaymentStore(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $payment = UserPayment::where('user_id', Auth::user()->id)->first();
        if ($payment) {
            $payment->update($data);
        } else {
            UserPayment::create($data);
        }
        return redirect()->back();
    }
}
