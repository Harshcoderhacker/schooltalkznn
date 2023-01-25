<div>
    {{-- Configure Class --}}
    @include(
        'livewire.admin.exam.createexam.createexamentryform.configureclass'
    )
    {{-- Subject marks --}}
    @include(
        'livewire.admin.exam.createexam.createexamentryform.subjectmarks'
    )
    {{-- Exam Schedule --}}
    @include(
        'livewire.admin.exam.createexam.createexamentryform.classexamschedule'
    )
    {{-- Exam Confirmation --}}
    @include(
        'livewire.admin.exam.createexam.createexamentryform.examconfirmation'
    )
</div>
