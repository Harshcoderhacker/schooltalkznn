<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 1 ? '' : 'hidden' }}">
    @include('admin.accounts..fee.helper.createfeeformwizard', [
    'active' => 'createfee',
    ])
    <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 w-full mx-0 sm:mx-auto border-none">
        <form wire:submit.prevent="validatecreatefeeinfo" autocomplete="off">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="name" class="form-label font-semibold">Fees Name</label>
                    <input wire:model="name" id="name" type="text" class="form-control">
                    @error('name')
                    <span class="font-semibold text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="due_date" class="form-label font-semibold">Due Date</label>
                    <input type="date" wire:model="due_date" id="due_date" class="form-control" placeholder="Due Date">
                    @error('due_date')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="classmaster_id" class="form-label font-semibold">Class Name</label>
                    <select wire:model="classmaster_id" id="classmaster_id" class="form-select w-full">
                        <option value="0">Select Class </option>
                        @foreach ($classmaster as $eachclassmaster)
                        <option value="{{ $eachclassmaster->id }}">
                            {{ $eachclassmaster->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('classmaster_id')
                    <span class="font-semibold text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="section" class="form-label font-semibold">Section</label>
                    <select wire:model="section" id="section" class="form-select section-dropdown" multiple>
                        @foreach ($section_data as $eachsection)
                        <option value="{{ $eachsection->id }}">
                            {{ $eachsection->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('section')
                    <span class="font-semibold text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 flex items-center justify-center sm:justify-end mt-5 mb-5">
                    <a href="{{ route('adminfee') }}" class="btn btn-danger w-24">Cancel</a>
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