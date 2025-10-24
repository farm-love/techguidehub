<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data" x-data="profileForm()">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- bio will be handled after email block to provide reactive counter -->

        <div>
            <x-input-label for="avatar" :value="__('Avatar')" />

            <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                    <template x-if="previewUrl">
                        <img :src="previewUrl" alt="avatar preview" class="w-20 h-20 rounded-full object-cover" />
                    </template>

                    <template x-if="!previewUrl">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="avatar" class="w-20 h-20 rounded-full object-cover" />
                        @else
                            <div class="w-20 h-20 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a5 5 0 100-10 5 5 0 000 10zm-8 7a8 8 0 1116 0H2z"/></svg>
                            </div>
                        @endif
                    </template>
                </div>

                <div class="flex-1">
                    <input id="avatar" name="avatar" type="file" accept="image/*" @change="preview($event)" class="block w-full text-sm text-gray-900 dark:text-gray-200 file:rounded file:border-0 file:bg-gray-200 file:dark:bg-gray-700 file:py-2 file:px-3" />
                    <x-input-error class="mt-2" :messages="$errors->get('avatar')" />

                    <label class="inline-flex items-center mt-2">
                        <input type="checkbox" name="remove_avatar" value="1" x-model="removeAvatar" class="rounded text-red-600 border-gray-300 dark:border-gray-600" />
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remove avatar</span>
                    </label>
                </div>
            </div>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
            <x-input-label for="twitter" :value="__('Twitter')" />
            <x-text-input id="twitter" name="twitter" type="text" class="mt-1 block w-full" :value="old('twitter', $user->twitter)" autocomplete="twitter" />
            <x-input-error class="mt-2" :messages="$errors->get('twitter')" />
        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <textarea id="bio" name="bio" x-model="bio" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" rows="3">{{ old('bio', $user->bio) }}</textarea>
            <div class="flex justify-between items-center mt-1">
                <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                <div class="text-sm text-gray-500 dark:text-gray-400"> <span x-text="bio.length"></span>/1000</div>
            </div>
        </div>
        <div>
            <x-input-label for="twitter" :value="__('Twitter')" />
            <x-text-input id="twitter" name="twitter" type="text" class="mt-1 block w-full" :value="old('twitter', $user->twitter)" autocomplete="twitter" />
            <x-input-error class="mt-2" :messages="$errors->get('twitter')" />
        </div>
            <x-input-error class="mt-2" :messages="$errors->get('github')" />
        </div>

        <div>
            <x-input-label for="website" :value="__('Website')" />
            <x-text-input id="website" name="website" type="url" class="mt-1 block w-full" :value="old('website', $user->website)" autocomplete="url" />
            <x-input-error class="mt-2" :messages="$errors->get('website')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    function profileForm() {
        return {
            previewUrl: null,
            removeAvatar: false,
            bio: `{{ addslashes(old('bio', $user->bio ?? '')) }}`,
            preview(event) {
                const file = event.target.files[0];
                if (!file) {
                    this.previewUrl = null;
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.previewUrl = e.target.result;
                    // uncheck removeAvatar if selecting a new file
                    this.removeAvatar = false;
                };
                reader.readAsDataURL(file);
            }
        }
    }
</script>
