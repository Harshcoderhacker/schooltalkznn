<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 4 ? '' : 'hidden' }}">
    @include('admin.staff.helper.addstaffformwizard', [
        'active' => 'documents',
    ])
    <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
        <form wire:submit.prevent="staffdocumentupload" autocomplete="off">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label class="flex form-label font-semibold">Resume
                        @if ($existing_resume)
                            {{ $existing_resume }}
                            <i data-feather="check-circle" class="h-5 w-5 mx-2 text-theme-9"></i>
                        @endif
                    </label>
                    <input wire:model.lazy="resume" type="file" class="form-control">
                    @error('resume')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label class="flex form-label font-semibold">Degree Certificate
                        @if ($existing_degree_certificate)
                            {{ $existing_degree_certificate }}
                            <i data-feather="check-circle" class="h-5 w-5 mx-2 text-theme-9"></i>
                        @endif
                    </label>
                    <input wire:model.lazy="degree_certificate" type="file" class="form-control">
                    @error('degree_certificate')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label class="flex form-label font-semibold">School Certificate
                        @if ($existing_school_certificate)
                            {{ $existing_school_certificate }}
                            <i data-feather="check-circle" class="h-5 w-5 mx-2 text-theme-9"></i>
                        @endif
                    </label>
                    <input wire:model.lazy="school_certificate" type="file" class="form-control">
                    @error('school_certificate')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label class="flex form-label font-semibold">Document 1
                        @if ($existing_document_one)
                            {{ $existing_document_one }}
                            <i data-feather="check-circle" class="h-5 w-5 mx-2 text-theme-9"></i>
                        @endif
                    </label>
                    <input wire:model.lazy="document_one" type="file" class="form-control">
                    @error('document_one')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label class="flex form-label font-semibold">Document 2
                        @if ($existing_document_two)
                            {{ $existing_document_two }}
                            <i data-feather="check-circle" class="h-5 w-5 mx-2 text-theme-9"></i>
                        @endif
                    </label>
                    <input wire:model.lazy="document_two" type="file" class="form-control">
                    @error('document_two')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label class="flex form-label font-semibold">Document 3
                        @if ($existing_document_three)
                            {{ $existing_document_three }}
                            <i data-feather="check-circle" class="h-5 w-5 mx-2 text-theme-9"></i>
                        @endif
                    </label>
                    <input wire:model.lazy="document_three" type="file" class="form-control">
                    @error('document_three')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="intro-x col-span-12 flex items-center justify-center sm:justify-end mt-5 mb-5">
                    <button wire:click="back(3)" type="button" class="btn btn-secondary w-24">Previous</button>
                    <button type="submit" class="btn btn-primary w-24 mx-2 text-center">
                        <div wire:loading>
                            @include('helper.loadingicon.loadingicon')
                        </div>
                        <span wire:loading.remove>Submit</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
