<div class="col-span-12 lg:col-span-12 2xl:col-span-12 hidden md:block lg:block xl:block 2xl:block">
    <div class="intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-center">
                <a href="{{ route('section.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'section' ? 'bg-primary text-white' : '' }}">Section</a>
                <a href="{{ route('classmaster.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'class' ? 'bg-primary text-white' : '' }}">Class</a>
                <a href="{{ route('subject.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'subject' ? 'bg-primary text-white' : '' }}">Subjects</a>
                <a href="{{ route('assignsubject.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'assignsubject' ? 'bg-primary text-white' : '' }}">Assign
                    Subjects</a>
                <a href="{{ route('classroutine.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'classroutine' ? 'bg-primary text-white' : '' }}">Class
                    Routines</a>
                <a href="{{ route('timetable.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'timetable' ? 'bg-primary text-white' : '' }}">Time
                    Table</a>
            </div>
        </div>
    </div>
</div>