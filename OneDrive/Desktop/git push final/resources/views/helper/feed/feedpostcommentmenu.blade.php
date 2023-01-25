<div class="dropdown ml-3">
    <button class="dropdown-toggle w-8 h-8 flex items-center justify-center rounded-full" aria-expanded="false"
        data-tw-toggle="dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-more-horizontal">
            <circle cx="12" cy="12" r="1"></circle>
            <circle cx="19" cy="12" r="1"></circle>
            <circle cx="5" cy="12" r="1"></circle>
        </svg>
    </button>
    <div class="dropdown-menu w-44">
        <ul class="dropdown-content">
            <li>
                <div data-tw-toggle="modal" data-tw-target="#delete-modal-preview-{{ $uuid }}"
                    class="dropdown-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-trash-2 mr-2">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                        </path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                    Delete Comment
                </div>
            </li>
            <li>
                <div data-tw-dismiss="dropdown" wire:click="editpostcomment({{ $id }})" class="dropdown-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-edit mr-2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                        </path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                        </path>
                    </svg>
                    Edit Comment
                </div>
            </li>
        </ul>
    </div>
</div>
{{-- For confirm and delete --}}
<div id="delete-modal-preview-{{ $uuid }}" class="modal" tabindex="-1" aria-hidden="true">
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
                        wire:click="deletecommment('{{ $id }}')">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
