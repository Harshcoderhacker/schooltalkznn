@if ($isshowmodalopen && $fieldshowdata)
    <div class="fixed inset-0  z-50 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <div
        class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
        <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-4/12 shadow-2xl">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h2 class="font-bold text-lg text-white mr-auto">Field</h2>
                        <button wire:click="fieldclosemodal"
                            class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                        @include('helper.show.show',
                        ['label'=> 'ID',
                        'value'=> $fieldshowdata->uniqid])

                        @include('helper.show.show',
                        ['label'=> 'FIELD NAME',
                        'value'=> $fieldshowdata->name])

                        @include('helper.show.show',
                        ['label'=> 'FIELD FOR',
                        'value'=> $fieldshowdata->field_for])

                        @include('helper.show.show',
                        ['label'=> 'FIELD TYPE',
                        'value'=> $fieldshowdata->field_type])

                        @include('helper.show.show',
                        ['label'=> 'CREATED BY',
                        'value'=> $fieldshowdata->created_by])

                        @include('helper.show.show',
                        ['label'=> 'CREATED AT',
                        'value'=> $fieldshowdata->created_at->format('d-M-Y h:i:s')])

                        @if ($fieldshowdata->updated_by)
                            @include('helper.show.show',
                            ['label'=> 'UPDATED BY',
                            'value'=> $fieldshowdata->updated_by])

                            @include('helper.show.show',
                            ['label'=> 'UPDATED AT',
                            'value'=> $fieldshowdata->updated_at->format('d-M-Y h:i:s')])
                        @endif

                    </div>
                    <div class="modal-footer text-right">
                        <button type="button" wire:click="fieldclosemodal"
                            class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
