@if (env('SCHOOLTALKZ') == false)
    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
        <div
            class="my-auto sm:my-32 mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
            <div class="tab-content mt-10">
                <div id="layout-admin">
                    @include('login.verifyotp')
                </div>
            </div>
        </div>
    </div>
@else
    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
        <div
            class="my-auto sm:my-32 mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
            <div id="layout-admin" {{ $panel ?? '' == 'adminlogin' ? '' : 'hidden' }}>
                @include('login.verifyotp')
            </div>
        </div>
    </div>
@endif
