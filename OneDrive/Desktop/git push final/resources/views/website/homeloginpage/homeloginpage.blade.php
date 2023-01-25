@extends('../layout/admin/login')

@section('head')
    <title>Login Edfish</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="{{ URL('/') }}" class="-intro-x flex items-center pt-5">
                    <img alt="Edfish School ERP Software" class="w-24"
                        src="{{ asset('dist/images/logo.png') }}">
                </a>
                <div class="my-auto">
                    <img alt="Edfish School ERP Software" class="-intro-x w-1/2 -mt-16"
                        src="{{ asset('dist/images/home.png') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">Get more things done with
                        <br> Edfish platform.
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-gray-500">The Complete Ecosystem
                        of Education</div>
                </div>
            </div>
           
            
            @if($panel != 'adminlogin')                
                @livewire('common.login.verifyotp', ['panel' => $panel])
              
            @else
            
            @livewire('common.login.loginlivewire', ['panel' => $panel ])
            @endif
        </div>
    </div>
@endsection
