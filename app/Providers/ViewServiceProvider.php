<?php

namespace App\Providers;

use App\Models\ActiveLanguage;
use App\Models\Language;
use App\Models\Massage;
use App\Models\Notification;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    public function boot()
    {

        View::composer('admin.body.header', function ($view) {

            $massages = Massage::get();

            $view->with('massages', $massages);
        });

        View::composer('admin.body.admin_dashboard', function ($view) {

            $personal = Personal::first();

            $view->with('personal', $personal);
        });
        View::composer('admin.body.header', function ($view) {

            $personal = Personal::first();

            $view->with('personal', $personal);
        });

        View::composer('layouts.fontend.master', function ($view) {

            $personal = Personal::first();

            $view->with('personal', $personal);
        });

        View::composer('layouts.fontend.dashboard', function ($view) {

            $personal = Personal::first();

            $view->with('personal', $personal);
        });


        View::composer('layouts.fontend.dashboard', function ($view) {
            if (Auth::user()) {
                $notifications = Notification::where('to_id', Auth::user()->id)->orderBy('id','DESC')->get();
            } else {
                $notifications = [];
            }

            $view->with('notifications', $notifications);
        });

        View::composer('layouts.fontend.master', function ($view) {
            if (Auth::user()) {
                $unread_notifications = Notification::where('to_id', Auth::user()->id)->where('status',0)->orderBy('id','DESC')->get();
            } else {
                $unread_notifications = [];
            }

            $view->with('unread_notifications', $unread_notifications);
        });

        View::composer('admin.chat_master', function ($view) {
            $authUserId = Auth::id();

            // Subquery to get the latest message ID for each user conversation
            $latestMessages = DB::table('massages')
                ->select(DB::raw('GREATEST(from_id, to_id) as user1'), DB::raw('LEAST(from_id, to_id) as user2'), DB::raw('MAX(id) as latest_id'))
                ->where(function ($query) use ($authUserId) {
                    $query->where('from_id', $authUserId)
                        ->orWhere('to_id', $authUserId);
                })
                ->groupBy(DB::raw('GREATEST(from_id, to_id)'), DB::raw('LEAST(from_id, to_id)'));

            // Convert the subquery to a joinable format
            $latestMessages = DB::table(DB::raw("({$latestMessages->toSql()}) as latest_messages"))
                ->mergeBindings($latestMessages); // merge bindings to resolve parameters

            // Join with the massages table using Eloquent for the main query
            $lastMessages = \App\Models\Massage::joinSub($latestMessages, 'latest_messages', function ($join) {
                $join->on('massages.id', '=', 'latest_messages.latest_id');
            })
                ->with(['fromUser', 'toUser']) // Load related user data
                ->orderBy('massages.created_at', 'desc')
                ->get();

            $view->with('massages', $lastMessages);
        });
        View::composer('admin.chat_master', function ($view) {
            $users  = User::get();
            $view->with('users', $users);
        });


        View::composer('layouts.fontend.chat_master', function ($view) {
            $authUserId = Auth::id();

            // Subquery to get the latest message ID for each user conversation
            $latestMessages = DB::table('massages')
                ->select(DB::raw('GREATEST(from_id, to_id) as user1'), DB::raw('LEAST(from_id, to_id) as user2'), DB::raw('MAX(id) as latest_id'))
                ->where(function ($query) use ($authUserId) {
                    $query->where('from_id', $authUserId)
                        ->orWhere('to_id', $authUserId);
                })
                ->groupBy(DB::raw('GREATEST(from_id, to_id)'), DB::raw('LEAST(from_id, to_id)'));

            // Convert the subquery to a joinable format
            $latestMessages = DB::table(DB::raw("({$latestMessages->toSql()}) as latest_messages"))
                ->mergeBindings($latestMessages); // merge bindings to resolve parameters

            // Join with the massages table using Eloquent for the main query
            $lastMessages = \App\Models\Massage::joinSub($latestMessages, 'latest_messages', function ($join) {
                $join->on('massages.id', '=', 'latest_messages.latest_id');
            })
                ->with(['fromUser', 'toUser']) // Load related user data
                ->orderBy('massages.created_at', 'desc')
                ->get();

            $view->with('massages', $lastMessages);
        });
    }
}
