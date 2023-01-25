<tr class="intro-x">
    <td>
        <span class="text-sm font-medium whitespace-nowrap">
            {{ $eachhomeworklist->student->addmission_number }}
        </span>
    </td>
    <td>
        <span class="text-sm font-medium whitespace-nowrap">
            {{ $eachhomeworklist->student->name }}
        </span>
    </td>
    <td class="text-sm font-semibold whitespace-nowrap">
        <form>
            <div class="relative text-gray-700 dark:text-gray-300">
                <input type="number" class="form-control text-center w-20" wire:model.debounce.500ms="marks"
                    {{ $eachhomeworklist->submissionfile != null && $eachhomeworklist->homework_status == true ? '' : 'disabled' }}>
            </div>
            @error('marks')
                <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
            @enderror
        </form>
    </td>
    <td class="table-report__action w-12 text-center">
        <div class="flex justify-center items-center">
            <div class="form-check form-switch flex flex-col items-start">
                @if ($eachhomeworklist->submissionfile != null && $eachhomeworklist->homework_status == true ? 'hidden' : '')
                    <input wire:model="homework_status" class="form-check-input" type="checkbox"
                        {{ $homework_status ? 'checked' : '' }}>
                @else
                    <span class="text-red-600">-</span>
                @endif
            </div>
        </div>
    </td>
    <td>
        <div class="text-sm justify-center items-center font-medium whitespace-nowrap flex flex-row gap-2">
            @if ($eachhomeworklist->staff_homework_status == 1)
                <span class="text-red-600 font-semibold">Not Uploaded</span>
            @elseif($eachhomeworklist->staff_homework_status == 2)
                <span class="text-orange-600 font-semibold">In Progress</span>
            @elseif($eachhomeworklist->staff_homework_status == 3)
                <button wire:click="downloadhomeworksubmission()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-download">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                </button>
            @else
                <span class="text-red-600 font-semibold">Not Completed</span>
            @endif
        </div>
    </td>
    <td>
        <div class="flex gap-4">
            <div class="relative" wire:click="commenttoggle({{ $eachhomeworklist->id }})">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-message-square w-7 h-7 text-theme-9">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z">
                    </path>
                </svg>
                <div class="absolute bottom-4 left-3">
                    <span
                        class="btn btn-primary w-1 h-1 rounded-full">{{ $eachhomeworklist->homeworkcomment->count() }}</span>
                </div>
            </div>
            <div>
                @if ($is_read)
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="green"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                @endif
            </div>
        </div>
    </td>
</tr>
