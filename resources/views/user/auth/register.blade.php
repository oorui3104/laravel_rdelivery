<x-guest-layout>
    <form method="POST" action="{{ route('user.register') }}">
        @csrf

        <div class="w-24 mx-auto mb-6">
            <a href="/">
                <x-application-logo class="w-12 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <!-- Email Address -->
        <h1 class="mb-4 text-center" >新規登録</h1>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('名前')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="postcode" :value="__('郵便番号')" />
            <x-text-input id="postcode" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode')" required autocomplete="" placeholder="例:194-0000"/>
            <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="address" :value="__('住所')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="" placeholder="例:東京都江東区1-11-1"/>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('パスワード（確認）')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('user.login') }}">
                登録済みの場合はこちら
            </a>

            <x-primary-button class="ml-4">
                登録
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
