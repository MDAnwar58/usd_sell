<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('delete')
        <div class="mt-6">
            <x-input-label for="password" value="Password" class="sr-only" />

            <x-text-input
                id="password"
                name="password"
                type="password"
                class="form-control"
                placeholder="Password"
            />

            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
        </div>
    <x-danger-button class="btn btn-danger mt-2"
     type='submit'
    >{{ __('Delete Account') }}</x-danger-button>
</form>

</section>
