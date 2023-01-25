<div class="p-4 flex border-b-2">
    <nav aria-label="breadcrumb" class="intro-x mr-auto hidden sm:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('staffdashboard') }}">Home</a></li>
            @yield('breadcrumb')
        </ol>
    </nav>
    <div class="flex ml-auto">
        @livewire('common.notifiction.notificationlivewire',[
        'platform' => 'staff',
        ])
        <div class="intro-x dropdown w-8 h-8 p-2 sm:ml-auto">
            @include('layout.darkmode.darkmodedesgin')
        </div>
        <div class="intro-x dropdown w-8 h-8">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button"
                aria-expanded="false" data-tw-toggle="dropdown">
                @if (auth()->guard('staff')->user()->avatar)
                    <img alt="{{ auth()->guard('staff')->user()->name }}"
                        src=" {{ auth()->guard('staff')->user()->avatar }}">
                @else
                    <img alt="{{ auth()->guard('staff')->user()->name }}"
                        src="{{ asset('image/dummy/200x200.jpg') }}">
                @endif
            </div>
            <div class="dropdown-menu w-56">
                <ul class="dropdown-content bg-primary text-white">
                    <li class="p-2">
                        <div class="font-medium">{{ auth()->guard('staff')->user()?->name }}</div>
                        <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">
                            {{ auth()->guard('staff')->designation ?? 'Staff' }}</div>
                    </li>
                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li>
                    <li>
                        <a href="" class="dropdown-item hover:bg-white/5">
                            <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item hover:bg-white/5">
                            <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li>
                    <li>
                        <a href="{{ route('stafflogout') }}" class="dropdown-item hover:bg-white/5">
                            <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
