<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();
        return view('backend.about.index', compact('about'));
    }
    public function store(Request $request)
    {
        $about = AboutUs::first();

        if ($about) {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $fileName = date('y-m-d') . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

                $request->file('image')->move(storage_path('/app/public/image'), $fileName);

                $data['image'] = '/storage/image/' . $fileName;
            }

            $about->update(
                $data
            );
        } else {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $fileName = date('y-m-d') . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

                $request->file('image')->move(storage_path('/app/public/image'), $fileName);

                $data['image'] = '/storage/image/' . $fileName;
            }
            AboutUs::create($data);
        }

        $notification = array(
            'message' => 'AboutUs Information Updated Successfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
    }
}
