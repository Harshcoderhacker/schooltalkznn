<div>
    {{-- Configure Class --}}
    @include(
        'livewire.staff.exam.createexam.createexamentryform.staffconfigureclass'
    )
    {{-- Subject marks --}}
    @include(
        'livewire.staff.exam.createexam.createexamentryform.staffsubjectmarks'
    )
    {{-- Exam Schedule --}}
    @include(
        'livewire.staff.exam.createexam.createexamentryform.staffclassexamschedule'
    )
    {{-- Exam Confirmation --}}
    @include(
        'livewire.staff.exam.createexam.createexamentryform.staffexamconfirmation'
    )
</div>
