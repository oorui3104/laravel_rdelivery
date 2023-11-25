<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <div class="w-24">
                        <a href="{{ route('user.items.index') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if(auth('users')->user())
                        <x-nav-link :href="route('user.login')" :active="request()->routeIs('user.login')">
                            ユーザー情報
                        </x-nav-link>
                        <x-nav-link :href="route('user.login')" :active="request()->routeIs('user.login')">
                            カートを見る
                        </x-nav-link>
                        <form class="inline-flex items-center" method="POST" action="{{ route('user.logout') }}">
                        @csrf
                            <button type="submit" class="h-full px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            ログアウト
                            </button>
                        </form>
                    @else
                        <x-nav-link :href="route('user.register')" :active="request()->routeIs('user.register')">
                            新規登録
                        </x-nav-link>
                        <x-nav-link :href="route('user.login')" :active="request()->routeIs('user.login')">
                            ログイン
                        </x-nav-link>
                    @endif
                </div>
            </div>

            {{-- <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>ゲスト</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('user.register')">
                            新規登録
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('user.login')">
                            ログイン
                        </x-dropdown-link>

                        <!-- Authentication -->
                        {{-- <form method="POST" action="{{ route('user.logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('user.logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form> --}}
                    {{-- </x-slot>
                </x-dropdown>
            </div> --}}

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        {{-- <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('user.items.index')" :active="request()->routeIs('user.items.index')">
                ホーム
            </x-responsive-nav-link>
        </div> --}}

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            {{-- <div class="px-4">
                <div class="font-medium text-base text-gray-800">ゲスト</div>
                <div class="font-medium text-sm text-gray-500">ゲスト</div>
            </div> --}}

            <div class="mt-3 space-y-1">
                @if(auth('users')->user())
                    <x-responsive-nav-link :href="route('user.login')">
                        ユーザー情報
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user.login')">
                        カートを見る
                    </x-responsive-nav-link>
                    <form class="w-full inline-flex items-center" method="POST" action="{{ route('user.logout') }}">
                        @csrf
                            <button type="submit" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                            ログアウト
                            </button>
                        </form>
                @else
                    <x-responsive-nav-link :href="route('user.register')">
                        新規登録
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user.login')">
                        ログイン
                    </x-responsive-nav-link>
                @endif



                <!-- Authentication -->
                {{-- <form method="POST" action="{{ route('user.logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('user.logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form> --}}
            </div>
        </div>
    </div>
</nav>
