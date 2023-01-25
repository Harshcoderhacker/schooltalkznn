<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 1 ? '' : 'hidden' }}">
    @include(
        'staff.exam.staffcreateexam.helper.staffcreateexamformwizard',
        ['active' => 'configureclass']
    )
    <div
        class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none w-full sm:w-10/12 mx-auto">
        <form wire:submit.prevent="validateconfigureclass" autocomplete="off">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-x col-span-12 sm:col-span-12">
                    <label for="input-wizard-1" class="form-label font-semibold">Examination</label>
                    <input wire:model="name" id="name" type="text" class="form-control">
                    @error('name')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label font-semibold">Class Name</label>
                    <select wire:model="classmaster_id" class="form-select w-full">
                        <option value="">Select Class </option>
                        @foreach ($classteacher->unique('classmaster_id') as $eachclassmaster)
                            <option value="{{ $eachclassmaster->classmaster->id }}">
                                {{ $eachclassmaster->classmaster->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('classmaster_id')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-3" class="form-label font-semibold">Section</label>
                    <select wire:model="section" class="form-select section-dropdown" multiple>
                        <option value="0">Select Section </option>
                        @if ($classmaster_id)
                            @foreach ($classteacher as $eachsection)
                                <option value="{{ $eachsection->section->id }}">
                                    {{ $eachsection->section->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('section')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 flex items-center justify-center sm:justify-end mt-5 mb-5">
                    <a href="{{ route('staffcreateexamindex') }}" class="btn btn-danger w-24">Cancel</a>
                    <button type="submit" class="btn btn-primary w-24 ml-2">Next</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
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
