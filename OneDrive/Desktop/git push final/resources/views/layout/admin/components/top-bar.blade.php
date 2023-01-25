    <div class="p-4 flex border-b-2">
        <nav aria-label="breadcrumb" class="intro-x mr-auto hidden sm:flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admindashboard') }}">Home</a></li>
                @yield('breadcrumb')
            </ol>
        </nav>
        {{-- <div class="intro-x relative mr-3 sm:mr-6">
            <div class="search hidden sm:block">
                <input type="text" class="search__input form-control border-transparent" placeholder="Search...">
                <i data-feather="search" class="search__icon dark:text-slate-500"></i>
            </div>
            <a class="notification sm:hidden" href="">
                <i data-feather="search" class="notification__icon dark:text-slate-500"></i>
            </a>
            <div class="search-result">
                <div class="search-result__content">
                    <div class="search-result__content__title">Pages</div>
                    <div class="mb-5">
                        <a href="" class="flex items-center">
                            <div
                                class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                                <i class="w-4 h-4" data-feather="inbox"></i>
                            </div>
                            <div class="ml-3">Mail Settings</div>
                        </a>
                        <a href="" class="flex items-center mt-2">
                            <div class="w-8 h-8 bg-pending/10 text-pending flex items-center justify-center rounded-full">
                                <i class="w-4 h-4" data-feather="users"></i>
                            </div>
                            <div class="ml-3">Users & Permissions</div>
                        </a>
                        <a href="" class="flex items-center mt-2">
                            <div>
                                <i class="w-4 h-4" data-feather="credit-card"></i>
                            </div>
                            <div class="ml-3">Transactions Report</div>
                        </a>
                    </div>
                    <div class="search-result__content__title">Users</div>
                    <div class="mb-5">
                        @foreach (array_slice($fakers, 0, 4) as $faker)
                            <a href="" class="flex items-center mt-2">
                                <div class="w-8 h-8 image-fit">
                                    <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"
                                        src="{{ asset('dist/images/' . $faker['photos'][0]) }}">
                                </div>
                                <div class="ml-3">{{ $faker['users'][0]['name'] }}</div>
                                <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">
                                    {{ $faker['users'][0]['email'] }}</div>
                            </a>
                        @endforeach
                    </div>
                    <div class="search-result__content__title">Products</div>
                    @foreach (array_slice($fakers, 0, 4) as $faker)
                        <a href="" class="flex items-center mt-2">
                            <div class="w-8 h-8 image-fit">
                                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"
                                    src="{{ asset('dist/images/' . $faker['images'][0]) }}">
                            </div>
                            <div class="ml-3">{{ $faker['products'][0]['name'] }}</div>
                            <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">
                                {{ $faker['products'][0]['category'] }}</div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div> --}}
        <div class="flex ml-auto">
            @livewire('common.notifiction.notificationlivewire',[
            'platform' => 'admin',
            ])
            <div class="intro-x dropdown w-8 h-8 p-2 sm:ml-auto">
                @include('layout.darkmode.darkmodedesgin')
            </div>
            <div class="intro-x dropdown w-8 h-8">
                <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button"
                    aria-expanded="false" data-tw-toggle="dropdown">

                </div>
                <div class="dropdown-menu w-56">
                    <ul class="dropdown-content bg-primary text-white">
                        <li class="p-2">
                            <div class="font-medium">{{ auth()->user()?->name }}</div>
                            <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">
                                {{ auth()->user()->designation ?? 'Admin' }}</div>
                        </li>
                        <li>
                            <hr class="dropdown-divider border-white/[0.08]">
                        </li>
                        <li>
                            <a href="{{ route('adminprofile') }}" class="dropdown-item hover:bg-white/5">
                                <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('adminresetpassword') }}" class="dropdown-item hover:bg-white/5">
                                <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider border-white/[0.08]">
                        </li>
                        <li>
                            <a href="{{ route('adminlogout') }}" class="dropdown-item hover:bg-white/5">
                                <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
