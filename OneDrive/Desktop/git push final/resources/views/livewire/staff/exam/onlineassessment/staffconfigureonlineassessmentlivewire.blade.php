<div>
    <div class="fixed inset-0  z-50 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <div
        class="mt-10 mb-8 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
        <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-1/2 shadow-2xl">
            <div class="p-6 space-y-6 ">
                <div class="flex flex-row justify-between">
                    <div class="flex flex-row gap-4">
                        <img class="w-1/2 h-32 border-2" src="{{ $assessmenttemplate['image'] }}" alt="verb">
                        <div>
                            <p class="text-lg font-semibold">{{ $assessmenttemplate['name'] }}</p>
                            <p class="text-sm text-gray-500 font-semibold mt-3">
                                {{ sizeof($assessmentquestion) }} questions</p>
                            <p class="text-sm text-gray-500 font-semibold mt-3">5 minutes</p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <button class="btn btn-outline-danger w-40 zoom-in inline-block mr-1 mb-2"
                                wire:click="closeconfigure">Cancel and
                                Go
                                back</button>
                        </div>
                        <div>
                            <button wire:click="openconfiguremodel"
                                class="btn btn-outline-primary w-40 zoom-in inline-block mr-1 mb-2">Configure
                                Exam</button>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-x col-span-12 sm:col-span-6">
                            <label for="input-wizard-2" class="form-label font-semibold">Class</label>
                            <select class="form-select" wire:model.lazy="classmaster_id">
                                <option>Select A Class</option>
                                @foreach ($assignsubject as $key => $value)
                                    <option value={{ $value->classmaster_id }}>
                                        {{ $value->classmaster->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('classmaster_id')
                                <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="intro-x col-span-12 sm:col-span-6">
                            <label for="input-wizard-3" class="form-label font-semibold">Section</label>
                            <select wire:model="section" id="section" class="form-select section-dropdown" multiple>
                                @foreach ($sectionlist as $eachsection)
                                    <option value={{ $eachsection->section_id }}>
                                        {{ $eachsection->section->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('section')
                                <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="intro-x col-span-12 sm:col-span-12">
                            <label for="input-wizard-3" class="form-label font-semibold">Schedule Type</label><br>
                            <select wire:model="assigntype" class="form-select w-64 mt-2">
                                <option>Select Schedule Type </option>
                                <option value="1">
                                    Active Always
                                </option>
                                <option value="2">
                                    Schedulde On
                                </option>
                            </select>
                        </div>
                        @if ($assigntype == 2)
                            <div class="intro-x col-span-12 sm:col-span-6 mt-4">
                                <label for="input-wizard-2" class="form-label font-semibold">Start Date</label>
                                <br>
                                <input wire:model="start_date" type="date" class="w-full">
                                @error('start_date')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="intro-x col-span-12 sm:col-span-6 mt-4">
                                <label for="input-wizard-3" class="form-label font-semibold">End Date</label>
                                <br>
                                <input wire:model="end_date" type="date" class="w-full">
                                @error('end_date')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
                <div class="text-right mr-5 mt-4">
                    <button class="btn btn-primary w-32 text-right" wire:click="createassessment">Create</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            window.loadSelect2 = () => {
                $('.section-dropdown').select2().on('change', function() {
                    let data = $(this).val();
                    @this.set('section', data);
                });
            }
            loadSelect2();
            window.livewire.on('loadSelect2Hydrate', () => {
                loadSelect2();
            });
        });
    </script>
@endpush
