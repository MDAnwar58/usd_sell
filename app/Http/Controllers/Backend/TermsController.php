<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tarms;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        $terms = Tarms::first();
        return view('backend.terms.index', compact('terms'));
    }
    public function store(Request $request)
    {
        $terms = Tarms::first();

        if ($terms) {
            $data = $request->all();
            $terms->update(
                $data
            );
        } else {
            $data = $request->all();
            Tarms::create($data);
        }

        $notification = array(
            'message' => 'Tarms Information Updated Successfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
    }
}
