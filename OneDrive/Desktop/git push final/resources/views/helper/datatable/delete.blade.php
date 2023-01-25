<a wire:click="{{ $method }}('{{ $id }}')" class="flex items-center text-theme-6" href="javascript:;">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="red"
        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
        <polyline points="3 6 5 6 21 6"></polyline>
        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
        </path>
        <line x1="10" y1="11" x2="10" y2="17"></line>
        <line x1="14" y1="11" x2="14" y2="17"></line>
    </svg>
</a>
<div class="text-center">
    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-modal-preview-{{ $id }}" id="{{ $id }}id"
        class="btn btn-primary hidden"></a>
</div>
{{-- For confirm and delete --}}
<div id="delete-modal-preview-{{ $id }}" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
                        stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-x-circle mx-auto mt-3">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    <div class="text-3xl mt-5">Are you sure?</div>
                    <div class="text-gray-600 dark:text-white mt-2">Do you really
                        want to
                        delete this record? <br>This process
                        cannot
                        be undone.</div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button type="button" data-tw-dismiss="modal"
                        class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                    <button type="button" class="btn btn-danger w-24" data-tw-dismiss="modal"
                        wire:click="delete('{{ $id }}')">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>