<ul class="nav nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center" role="tablist">
    <li id="profile-tab" class="nav-item" role="presentation">
        <a href="{{ route('adminstaffprofileinfo', ['staff' => $staff]) }}"
            class="nav-link py-1 flex items-center {{ $activestatus == 'profile' ? 'active' : '' }}"
            role="tab">Profile </a>
    </li>
    <li id="payroll-tab" class="nav-item" role="presentation">
        <a href="{{ route('adminstaffpayrollinfo', ['staff' => $staff]) }}"
            class="nav-link py-1 flex items-center {{ $activestatus == 'payroll' ? 'active' : '' }}"
            role="tab">Payroll </a>
    </li>
    <li id="leaves-tab" class="nav-item" role="presentation">
        <a href="{{ route('adminstaffleaveinfo', ['staff' => $staff]) }}"
            class="nav-link py-1 flex items-center {{ $activestatus == 'leaves' ? 'active' : '' }}"
            role="tab">Leaves </a>
    </li>
    <li id="documents-tab" class="nav-item" role="presentation">
        <a href="{{ route('adminstaffdocumentsinfo', ['staff' => $staff]) }}"
            class="nav-link py-1 flex items-center {{ $activestatus == 'documents' ? 'active' : '' }}"
            role="tab">Documents </a>
    </li>
    <li id="classroutine-tab" class="nav-item" role="presentation">
        <a href="{{ route('adminstaffclassroutineinfo', ['staff' => $staff]) }}"
            class="nav-link py-1 flex items-center {{ $activestatus == 'classroutine' ? 'active' : '' }}"
            role="tab">Class Routines </a>
    </li>
</ul>