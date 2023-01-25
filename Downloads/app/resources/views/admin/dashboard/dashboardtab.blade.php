<ul class="nav nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center" role="tablist">
    @if (env('SCHOOLTALKZ') == false)
        <li id="dashboard-tab" class="nav-item" role="presentation">
            <a href="{{ route('admindashboard') }}"
                class="nav-link py-1 flex items-center {{ $activestatus == 'admindashboard' ? 'bg-primary text-white rounded-lg' : '' }}"
                role="tab">
                Dashboard
            </a>
        </li>
    @endif
    <li id="schooltalkz_dashboard-tab" class="nav-item" role="presentation">
        <a href="{{ route('adminschooltalkzdashboard') }}"
            class="nav-link py-1 flex items-center {{ $activestatus == 'schooltalkz_dashboard' ? 'bg-primary text-white rounded-lg' : '' }}"
            role="tab">
            School Talkz Dashboard
        </a>
    </li>
    <li id="emotioncapture_dashboard-tab" class="nav-item" role="presentation">
        <a href="{{ route('adminemotioncapturedashboard') }}"
            class="nav-link py-1 flex items-center {{ $activestatus == 'emotioncapture_dashboard' ? 'bg-primary text-white rounded-lg' : '' }}"
            role="tab">
            Emotion Capture Dashboard
        </a>
    </li>
</ul>
