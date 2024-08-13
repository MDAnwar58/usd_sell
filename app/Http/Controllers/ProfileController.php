<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function profile()
    {
        return view('frontend.dashboard.index');
    }
    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'nid_no' => 'nullable|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nid_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nid_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->handleFileUpload($request, 'photo', $user->photo, 'public/photo');
        }

        $user->update($validated);

        return Redirect::route('user_profile')->with('status', 'profile-updated');
    }

    private function handleFileUpload(Request $request, $field, $currentFilePath, $storagePath)
    {
        if ($request->hasFile($field)) {
            if ($currentFilePath && Storage::exists(str_replace('/storage', 'public', $currentFilePath))) {
                Storage::delete(str_replace('/storage', 'public', $currentFilePath));
            }

            $fileName = date('y-m-d') . '-' . time() . '.' . $request->file($field)->getClientOriginalExtension();
            $path = $request->file($field)->storeAs($storagePath, $fileName);

            return Storage::url($path);
        }

        return $currentFilePath;
    }
    public function VarifyDocument(Request $request)
    {
        $user = Auth::user();

        $validated['document_type'] = $request->document_type;
        // Handle NID_1 upload
        if ($request->hasFile('nid_1')) {
            $validated['nid_1'] = $this->handleFileUpload($request, 'nid_1', $user->nid_1, 'public/nid_1');
        }

        // Handle NID_2 upload
        if ($request->hasFile('nid_2')) {
            $validated['nid_2'] = $this->handleFileUpload($request, 'nid_2', $user->nid_2, 'public/nid_2');
        }

        // Set email_verified_at to now
        if ($request->hasFile('nid_1')) {
            $validated['email_verified_at'] = now();
        }

        $user->update($validated);
        return Redirect::route('user_profile')->with('status', 'profile-updated');

    }



    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
