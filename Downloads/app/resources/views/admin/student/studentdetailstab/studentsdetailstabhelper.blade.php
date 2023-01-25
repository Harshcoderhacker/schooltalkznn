<ul class="nav nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center" role="tablist">
    <li id="profile-tab" class="nav-item" role="presentation">
        <a href="{{ route('adminstudentdetails', ['student' => $student]) }}"
            class="nav-link py-1 flex items-center {{ $activestatus == 'profile' ? 'active' : '' }}"
            role="tab">
            Profile
        </a>
    </li>
    <li id="fee-tab" class="nav-item" role="presentation">
        <a href="{{ route('adminstudentfeedetails',['student' => $student]) }}"
            class="nav-link py-1 flex items-center {{ $activestatus == 'fees' ? 'active' : '' }}"
            role="tab">
            Fees
        </a>
    </li>
    <li id="attendance-tab" class="nav-item" role="presentation">
        <a href="{{ route('adminstudentattendancedetails',['student' => $student]) }}"
            class="nav-link py-1 flex items-center {{ $activestatus == 'attendance' ? 'active' : '' }}"
            role="tab">
            Attendance
        </a>
    </li>
    <li id="marks-tab" class="nav-item" role="presentation">
        <a href="{{ route('adminstudentmarksdetails',['student' => $student]) }}"
            class="nav-link py-1 flex items-center {{ $activestatus == 'marks' ? 'active' : '' }}"
            role="tab">
            Marks
        </a>
    </li>
    <li id="progress-tab" class="nav-item" role="presentation">
        <a href="{{ route('adminstudentprogressdetails',['student' => $student]) }}"
            class="nav-link py-1 flex items-center {{ $activestatus == 'progress' ? 'active' : '' }}"
            role="tab">
            Progress
        </a>
    </li>
    <li id="documents-tab" class="nav-item" role="presentation">
        <a href="{{ route('adminstudentdocumentsdetails',['student' => $student]) }}"
            class="nav-link py-1 flex items-center {{ $activestatus == 'documents' ? 'active' : '' }}"
            role="tab">
            Documents
        </a>
    </li>
</ul>