<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodType;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $payment_methods = PaymentMethod::latest()->with('payment_method_type')->get();
        return view('backend.payment_method.index', compact('payment_methods'));
    } // End Method

    public function create()
    {
        $payment_method_types = PaymentMethodType::latest()->get();
        return view('backend.payment_method.create', compact('payment_method_types'));
    } // End Method

    public function edit($id)
    {
        $payment_method = PaymentMethod::find($id);
        $payment_method_types = PaymentMethodType::latest()->get();
        return view('backend.payment_method.edit', compact('payment_method', 'payment_method_types'));
    } // End Method
    public function show($id)
    {
        $payment_method = PaymentMethod::find($id);

        $image = $payment_method->image;
        $image_path = public_path($image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $payment_method->delete();
        $notification = array(
            'message' => 'PaymentMethod Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method

    public function store(Request $request)
    {

        $data = $request->all();

        if ($request->hasFile('image')) {
            $fileName = date('y-m-d') . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(storage_path('/app/public/image'), $fileName);

            $data['image'] = '/storage/image/' . $fileName;
        }
        PaymentMethod::create($data);

        $notification = array(
            'message' => 'PaymentMethod Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End If


    public function update(Request $request, $id)
    {

        $data = $request->all();
        $payment_method = PaymentMethod::find($id);
        if ($request->hasFile('image')) {

            $image = $payment_method->image;
            $image_path = public_path($image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $fileName = date('y-m-d') . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(storage_path('/app/public/image'), $fileName);

            $data['image'] = '/storage/image/' . $fileName;
        }
        $payment_method->update($data);
        $notification = array(
            'message' => 'PaymentMethod Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End If

    public function destroy($id)
    {
        $payment_method = PaymentMethod::find($id);

        $image = $payment_method->image;
        $image_path = public_path($image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $payment_method->delete();
        $notification = array(
            'message' => 'PaymentMethod Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
