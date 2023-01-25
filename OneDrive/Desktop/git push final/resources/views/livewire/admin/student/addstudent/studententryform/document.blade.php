<div class="intro-x box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 4 ? '' : 'hidden' }}">
    @include('admin.student.helper.addstudentformwizard', [
    'active' => 'documents',
    ])
    <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
        <form wire:submit.prevent="documents" autocomplete="off">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <!-- <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="adhaar_no" class="form-label font-semibold">Adhaar No</label>
                    <input id="adhaar_no" wire:model.lazy="adhaar_no" type="text" class="form-control">
                    @error('adhaar_no')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div> -->
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="photo" class="flex form-label font-semibold">Photo
                        @if ($existingphoto)
                        <i data-feather="check-circle" class="h-5 w-5 mx-2 text-theme-9"></i>
                        @else
                        <i class="h-5 w-5 mx-2 text-theme-6" data-feather="x-circle"></i>
                        @endif
                    </label>
                    @if ($photo)
                    <img class="rounded-md" src="{{ $photo->temporaryUrl() }}">
                    @elseif ($existingphoto)
                    <img class="rounded-md" src="{{ url('storage/' . $existingphoto) }}">
                    src="{{ asset('/image/settingsicon/profile/school.png') }}"
                    @else
                    No image Found
                    @endif
                    <input type="file" class="form-control" id="photo" wire:model.lazy="photo">
                    @error('photo')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 flex items-center justify-center sm:justify-end mt-5 mb-5">
                    <button wire:click="back(2)" type="button" class="btn btn-secondary w-24">Previous</button>
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