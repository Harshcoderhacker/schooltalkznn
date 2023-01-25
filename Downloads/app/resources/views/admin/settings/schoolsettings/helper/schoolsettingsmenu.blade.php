<div class="col-span-12 lg:col-span-12 2xl:col-span-12 hidden md:block lg:block xl:block 2xl:block">
    <div class="intro-y">
        <div class="box rounded-3xl shadow">
            <div class="nav justify-center">
                <a href="{{ route('generalsetting.index') }}"
                    class="flex-1 py-2 text-xs font-semibold rounded-3xl text-center  {{ $active == 'generalsetting' ? 'bg-primary text-white' : '' }}">General</a>
                <a href="{{ route('role.index') }}"
                    class="flex-1 py-2 text-xs font-semibold rounded-3xl text-center  {{ $active == 'role' ? 'bg-primary text-white' : '' }}">Role</a>
                <a href="{{ route('academicyear.index') }}"
                    class="flex-1 py-2 text-xs font-semibold rounded-3xl text-center  {{ $active == 'academic' ? 'bg-primary text-white' : '' }}">Academic
                    Year</a>
                <a href="{{ route('holiday.index') }}"
                    class="flex-1 py-2 text-xs font-semibold rounded-3xl text-center  {{ $active == 'holiday' ? 'bg-primary text-white' : '' }}">Holidays</a>
                <a href="{{ route('weekend.index') }}"
                    class="flex-1 py-2 text-xs font-semibold rounded-3xl text-center  {{ $active == 'weekend' ? 'bg-primary text-white' : '' }}">Weekend</a>
                <a href="{{ route('field.index') }}"
                    class="flex-1 py-2 text-xs font-semibold rounded-3xl text-center  {{ $active == 'field' ? 'bg-primary text-white' : '' }}">Field</a>
                <a href="{{ route('language.index') }}"
                    class="flex-1 py-2 text-xs font-semibold rounded-3xl text-center  {{ $active == 'language' ? 'bg-primary text-white' : '' }}">Language</a>
                <a href="{{ route('smstemplate.index') }}"
                    class="flex-1 py-2 text-xs font-semibold rounded-3xl text-center  {{ $active == 'smstemplate' ? 'bg-primary text-white' : '' }}">SMS
                </a>
                <a href="{{ route('emailtemplate.index') }}"
                    class="flex-1 py-2 text-xs font-semibold rounded-3xl text-center  {{ $active == 'emailtemplate' ? 'bg-primary text-white' : '' }}">Email
                </a>
                <a href="{{ route('loginpermission.index') }}"
                    class="flex-1 py-2 text-xs font-semibold rounded-3xl text-center  {{ $active == 'loginpermission' ? 'bg-primary text-white' : '' }}">
                    Permission</a>
            </div>
        </div>
    </div>
</div>