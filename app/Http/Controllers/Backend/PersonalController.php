<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Personal;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function index()
    {
        $personal = Personal::first();
        return view('backend.personal.index', compact('personal'));
    }
    public function store(Request $request)
    {
        $personal = Personal::first();

        if ($personal) {
            $data = $request->all();

            if ($request->hasFile('logo')) {
                $fileName = date('y-m-d') . '-' . time() . '.' . $request->file('logo')->getClientOriginalExtension();

                $request->file('logo')->move(storage_path('/app/public/logo'), $fileName);

                $data['logo'] = '/storage/logo/' . $fileName;
            }
            if ($request->hasFile('background_image')) {
                $fileName = date('y-m-d') . '-' . time() . '.' . $request->file('background_image')->getClientOriginalExtension();

                $request->file('background_image')->move(storage_path('/app/public/background_image'), $fileName);

                $data['background_image'] = '/storage/background_image/' . $fileName;
            }

            $personal->update(
                $data
            );
        }else{
            $data = $request->all();

            if ($request->hasFile('logo')) {
                $fileName = date('y-m-d') . '-' . time() . '.' . $request->file('logo')->getClientOriginalExtension();

                $request->file('logo')->move(storage_path('/app/public/logo'), $fileName);

                $data['logo'] = '/storage/logo/' . $fileName;
            }
            if ($request->hasFile('background_image')) {
                $fileName = date('y-m-d') . '-' . time() . '.' . $request->file('background_image')->getClientOriginalExtension();

                $request->file('background_image')->move(storage_path('/app/public/background_image'), $fileName);

                $data['background_image'] = '/storage/background_image/' . $fileName;
            }
            Personal::create($data);
        }

        $notification = array(
            'message' => 'Personal Information Updated Successfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);

    }
}
