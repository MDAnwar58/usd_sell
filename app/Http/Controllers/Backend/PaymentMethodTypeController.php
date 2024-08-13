<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethodType;
use Illuminate\Http\Request;

class PaymentMethodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_method_types = PaymentMethodType::latest()->get();
        return view('backend.payment_method_type.index', compact('payment_method_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.payment_method_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
        ]);

        PaymentMethodType::create($validated);

        $notification = array(
            'message' => 'Payment Method Type Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('payment_method_type.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment_method_type = PaymentMethodType::find($id);
        $payment_method_type->delete();

        $notification = array(
            'message' => 'Payment Method Type Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('payment_method_type.index')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment_method_type = PaymentMethodType::find($id);
        return view('backend.payment_method_type.edit', compact('payment_method_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
        ]);

        $payment_method_type = PaymentMethodType::find($id);
        $payment_method_type->update($validated);

        $notification = array(
            'message' => 'Payment Method Type Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('payment_method_type.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
