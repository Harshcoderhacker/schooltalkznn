@if ($platform == 'admin')
    <button wire:click="{{ $method }}('{{ $id }}')"
        class="intro-x w-8 h-8 flex items-center justify-center rounded-full border border-blue-300  mr-2 tooltip {{ auth()->user()->feedpostlike->where('feedpost_id', $id)->count() == 0? 'text-blue-500 dark:border-darkmode-400 dark:bg-darkmode-300 dark:text-blue-300': 'text-white btn-primary' }}"
    @elseif ($platform == 'staff') <button wire:click="{{ $method }}('{{ $id }}')"
        class="intro-x w-8 h-8 flex items-center justify-center rounded-full border border-blue-300  mr-2 tooltip {{ auth()->guard('staff')->user()->feedpostlike->where('feedpost_id', $id)->count() == 0? 'text-blue-500 dark:border-darkmode-400 dark:bg-darkmode-300 dark:text-blue-300': 'text-white btn-primary' }}"
    @elseif ($platform == 'student') <button wire:click="{{ $method }}('{{ $id }}')"
        class="intro-x w-8 h-8 flex items-center justify-center rounded-full border border-blue-300  mr-2 tooltip {{ \App\Models\Admin\Student\Student::find($user->id)->feedpostlike->where('feedpost_id', $id)->count() == 0? 'text-blue-500 dark:border-darkmode-400 dark:bg-darkmode-300 dark:text-blue-300': 'text-white btn-primary' }}"
        @endif
        title="Like">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-thumbs-up">
            <path
                d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3">
            </path>
        </svg>
    </button>
