@if ($iseditmodalopen && $assignsubjecteditdata)
    <div class="fixed inset-0  z-50 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <div
        class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
        <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-6/12 shadow-2xl">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h2 class="font-bold text-lg text-white mr-auto">Assign Subject</h2>
                        <button wire:click="assignsubjecteditclosemodal"
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
                        'value'=> $assignsubjecteditdata->uniqid])

                        @include('helper.show.show',
                        ['label'=> 'CLASS NAME',
                        'value'=> $assignsubjecteditdata->classmaster->name])

                        @include('helper.show.show',
                        ['label'=> 'SECTION NAME',
                        'value'=> $assignsubjecteditdata->section->name])

                        @include('helper.show.show',
                        ['label'=> 'SUBJECT NAME',
                        'value'=> $assignsubjecteditdata->subject->name])
                    </div>
                    <hr>



                    <div class="intro-y p-4 mx-5">
                        <div class="grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium">Assing Teacher</label>
                                <select wire:model="staffid" class="form-select w-full"
                                    data-placeholder="Select your Section">
                                    <option value="0">Select Section </option>
                                    @foreach ($staff as $eachstaff)
                                        <option value={{ $eachstaff->id }}>
                                            {{ $eachstaff->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-3">
                                <label class="form-label font-medium">Assign Subject</label>
                                <div class="form-check form-switch flex flex-col items-start">
                                    <input id="post-form-5" class="form-check-input" type="checkbox"
                                        wire:model.defer="isactive">
                                </div>
                                @error('isactive')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            @if ($is_classteacheralreadyasign == null || $is_classteacher)
                                <div class="col-span-12 sm:col-span-3">
                                    <label class="form-label font-medium">Is Class Teacher</label>
                                    <div class="form-check form-switch flex flex-col items-start">
                                        <input id="post-form-5" class="form-check-input" type="checkbox"
                                            wire:model.defer="is_classteacher">
                                    </div>
                                    @error('is_classteacher')
                                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            @else
                                <div class="col-span-12 sm:col-span-3">
                                    <label class="form-label font-medium">Class Teacher</label>
                                    <div class="text-green-600"> {{ $is_classteacheralreadyasign->staff->name }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="modal-footer text-right">
                        <button type="button" wire:click="update('{{ $assignsubjecteditdata->id }}')"
                            class="btn btn-primary w-20 mr-1">Submit</button>
                        <button type="button" wire:click="assignsubjecteditclosemodal"
                            class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
