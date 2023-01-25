
    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
        <div
            class="my-auto sm:my-32 mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
            <div class="intro-y flex justify-center mt-0">
                <div class="pricing-tabs nav nav-tabs box rounded-full overflow-hidden" role="tablist">
                    <button wire:click="toggle('adminlogin')" id="admin"
                        class="flex-1 w-32 lg:w-40 py-2 lg:py-3 whitespace-nowrap text-center {{ $panel == 'adminlogin' ? 'bg-primary text-white' : 'hover:bg-primary hover:text-white' }}"
                        role="tab">Admin</button>
                </div>
            </div>
            <div id="layout-admin" {{ $panel == 'adminlogin' ? '' : 'hidden' }}>
                @include('login.adminlogin')
            </div>
        </div>
    </div>

