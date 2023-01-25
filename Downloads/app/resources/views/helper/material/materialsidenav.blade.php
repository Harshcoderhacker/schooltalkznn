<div class="col-span-12 sm:col-span-2 grid grid-row-4 w-full sm:w-36 mx-auto intro-y h-auto lg:h-20 mt-6">
    <a wire:click="changematerialtype(1)"
        class="col-span-2 box rounded-none p-5 cursor-pointer zoom-in shadow-none intro-y {{ $material_type == 1 ? 'bg-primary text-white dark:bg-primary' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-file-text mx-auto w-8 h-8">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10 9 9 9 8 9"></polyline>
        </svg>
        <div class="font-medium text-base text-center mt-2">Syllabus</div>
    </a>
    <a wire:click="changematerialtype(2)"
        class="col-span-2 box rounded-none p-5 cursor-pointer zoom-in shadow-none intro-y {{ $material_type == 2 ? 'bg-primary text-white dark:bg-primary' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-layers mx-auto w-8 h-8">
            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
            <polyline points="2 17 12 22 22 17"></polyline>
            <polyline points="2 12 12 17 22 12"></polyline>
        </svg>
        <div class="font-medium text-base text-center mt-2">Lesson
            Contents</div>
    </a>
    <a wire:click="changematerialtype(3)"
        class="col-span-2 box rounded-none p-5 cursor-pointer zoom-in shadow-none intro-y {{ $material_type == 3 ? 'bg-primary text-white dark:bg-primary' : '' }}">

        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-folder-minus mx-auto w-8 h-8">
            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
            <line x1="9" y1="14" x2="15" y2="14"></line>
        </svg>
        <div class="font-medium text-base text-center mt-2">Documents</div>
    </a>
</div>
