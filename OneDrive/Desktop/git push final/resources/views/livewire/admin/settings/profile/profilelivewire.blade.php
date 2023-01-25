<div class="col-span-12 lg:col-span-12 2xl:col-span-12 mx-auto lg:w-7/12">
    <!-- BEGIN: Display Information -->

    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5 bg-primary">
            <h2 class="font-semibold text-white text-base mr-auto">Profile Information</h2>
        </div>
        <div class="p-5">
            <div class="flex flex-col-reverse xl:flex-row flex-col">
                <div class="flex-1 mt-6 xl:mt-0">
                    <form wire:submit.prevent="updateprofile">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 2xl:col-span-6">
                                <div>
                                    <label for="update-profile-form-1" class="form-label font-semibold">Name</label>
                                    <input wire:model="name" id="update-profile-form-1" type="text"
                                        class="form-control">
                                    @error('name')
                                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label font-semibold">Phone</label>
                                    <input id="update-profile-form-1" type="text" class="form-control"
                                        value="{{ auth()->user()->phone }}" disabled>
                                </div>
                            </div>
                            <div class="col-span-12 2xl:col-span-6">
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label font-semibold">Email</label>
                                    <input wire:model="email" id="update-profile-form-1" type="text"
                                        class="form-control">
                                    @error('email')
                                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label font-semibold">DOB</label>
                                    <input wire:model="dob" id="update-profile-form-1" type="date"
                                        class="form-control">
                                    @error('dob')
                                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 2xl:col-span-12">
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label font-semibold">Address</label>
                                    <input wire:model="address" id="update-profile-form-1" type="text"
                                        class="form-control">
                                    @error('address')
                                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-20 mt-3">Update</button>
                    </form>
                </div>
                <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                    <form wire:submit.prevent="uploadphoto">
                        <div class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5">

                            @if ($avatar)
                                <img class="rounded-md" src="{{ $avatar->temporaryUrl() }}">
                            @elseif ($existingavatar)
                                <img class="rounded-md" src="{{ url('storage/' . $existingavatar) }}">
                            @else
                                <img class="rounded-md" alt="edfish" src="{{ asset('image/dummy/200x200.jpg') }}">
                            @endif

                            @error('avatar')
                                <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror

                            <div class="mx-auto cursor-pointer relative mt-5">
                                <button type="submit" class="btn btn-primary w-full">Change Photo</button>
                                <input type="file" wire:model="avatar"
                                    class="w-full h-full top-0 left-0 absolute opacity-0">
                            </div>
                            @if ($avatar?->temporaryUrl())
                                <button type="submit" class="btn btn-success w-full mt-2">Save</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Display Information -->
</div>
