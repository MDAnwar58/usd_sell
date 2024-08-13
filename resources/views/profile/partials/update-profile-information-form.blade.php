<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class=" d-flex justify-content-center">
            <div class="card col-md-4 ">
                <img src="{{ asset($user->photo ?? 'frontend/assets/no_image.png') }}" height="50px" width="50px" alt="">
            </div>
        </div>
        <div>
            <x-input-label for="photo" :value="__('Name')" />
            <x-text-input id="photo" name="photo" type="file" class="form-control" />
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
        </div>
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="text" class="form-control" :value="old('phone', $user->phone)" required
                autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" name="address" type="text" class="form-control" :value="old('address', $user->address)" required
                autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="nid_no" :value="__('Nid Number')" />
            <x-text-input id="nid_no" name="nid_no" type="integer" class="form-control" :value="old('nid_no', $user->nid_no)" required
                autofocus autocomplete="nid_no" />
            <x-input-error class="mt-2" :messages="$errors->get('nid_no')" />
        </div>
        <div>
            <x-input-label for="unique_id" :value="__('Unique Id')" />
            <x-text-input id="unique_id" name="unique_id" type="integer" readonly class="form-control"
                :value="old('unique_id', $user->unique_id)" required autofocus autocomplete="unique_id" />
            <x-input-error class="mt-2" :messages="$errors->get('unique_id')" />
        </div>

        <div class=" d-flex ">
            <div class="card col-md-4 ">
                <img src="{{ asset($user->nid_1 ?? 'frontend/assets/no_image.png') }}" height="50px" width="50px" alt="">
            </div>
            <div class="card col-md-4 ">
                <img src="{{ asset($user->nid_2 ?? 'frontend/assets/no_image.png') }}" height="50px" width="50px" alt="">
            </div>
        </div>
        <div class="row">
            <div class="com-md-6">
                <x-input-label for="nid_1" :value="__('Nid First Page')" />
                <x-text-input id="nid_1" name="nid_1" type="file" class="form-control" />
                <x-input-error class="mt-2" :messages="$errors->get('nid_1')" />
            </div>
            <div class="com-md-6">
                <x-input-label for="nid_2" :value="__('Nid 2nd Page')" />
                <x-text-input id="nid_2" name="nid_2" type="file" class="form-control" />
                <x-input-error class="mt-2" :messages="$errors->get('nid_2')" />
            </div>
        </div>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required
                autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="p-3">
            <x-primary-button class="btn btn-info">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="btn btn-info">
                    {{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
