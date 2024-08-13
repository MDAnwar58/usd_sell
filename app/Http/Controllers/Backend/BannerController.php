<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::get();
        return view('backend.banner.index', compact('banners'));
    } // End Method

    public function create()
    {
        return view('backend.banner.create');
    } // End Method

    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('backend.banner.edit', compact('banner'));
    } // End Method

    public function store(Request $request)
    {

        $data = $request->all();

        if ($request->hasFile('image')) {
            $fileName = date('y-m-d') . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(storage_path('/app/public/image'), $fileName);

            $data['image'] = '/storage/image/' . $fileName;
        }
        Banner::create($data);

        $notification = array(
            'message' => 'Banner Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End If


    public function update(Request $request, $id)
    {

        $data = $request->all();
        $banner = Banner::find($id);
        if ($request->hasFile('image')) {

            $image = $banner->image;
            $image_path = public_path($image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $fileName = date('y-m-d') . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(storage_path('/app/public/image'), $fileName);

            $data['image'] = '/storage/image/' . $fileName;
        }
        $banner->update($data);
        $notification = array(
            'message' => 'Banner Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End If

    public function destroy($id)
    {
        $banner = Banner::find($id);

        $image = $banner->image;
        $image_path = public_path($image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $banner->delete();
        $notification = array(
            'message' => 'Banner Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
