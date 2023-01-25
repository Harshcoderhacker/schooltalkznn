<div class="col-start-5 col-span-5 hidden md:block lg:block xl:block 2xl:block">
    <div class=" intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-center">
                <a href="{{ route('examgrade.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'examgrade' ? 'bg-primary text-white' : '' }}">Exam
                    Grade</a>
                <a href="{{ route('exampasspercentage.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'exampasspercentage' ? 'bg-primary text-white' : '' }}">Exam
                    Pass Percentage</a>
            </div>
        </div>
    </div>
</div>