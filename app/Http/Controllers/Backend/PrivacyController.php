<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Privacy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index()
    {
        $privacy = Privacy::first();
        return view('backend.privacy.index', compact('privacy'));
    }
    public function store(Request $request)
    {
        $privacy = Privacy::first();

        if ($privacy) {
            $data = $request->all();
            $privacy->update(
                $data
            );
        } else {
            $data = $request->all();
            Privacy::create($data);
        }

        $notification = array(
            'message' => 'Privacy Information Updated Successfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
    }
}
