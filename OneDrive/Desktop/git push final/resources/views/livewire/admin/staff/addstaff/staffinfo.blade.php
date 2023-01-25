<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 1 ? '' : 'hidden' }}">
    @include('admin.staff.helper.addstaffformwizard', [
    'active' => 'staffinfo',
    ])
    <form wire:submit.prevent="staffinfo" autocomplete="off">
        <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-1" class="form-label font-semibold">Staff ID</label>
                    <input id="input-wizard-1" type="text" class="form-control" wire:model.lazy="staff_roll_id" placeholder="Staff ID">
                    @error('staff_roll_id')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-2" class="form-label font-semibold">First Name</label>
                    <input id="input-wizard-2" type="text" class="form-control" wire:model.lazy="name" placeholder="First Name">
                    @error('name')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-3" class="form-label font-semibold">Last Name</label>
                    <input id="input-wizard-2" type="text" class="form-control" wire:model.lazy="last_name" placeholder="Last Name">
                    @error('last_name')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-4" class="form-label font-semibold">Role</label>
                    <select wire:model.lazy="role" class="form-select w-full">
                        <option>Select A Role</option>
                        @foreach ($allrole as $value)
                        <option value={{ $value->id }}>
                            {{ $value->name }}
                        </option selected>
                        @endforeach
                    </select>
                    @error('role')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-5" class="form-label font-semibold">Department</label>
                    <select wire:model.lazy="staffdepartment_id" class="form-select w-full">
                        <option>Select A Department</option>
                        @foreach ($department as $key => $value)
                        <option value={{ $value->id }}>
                            {{ $value->name }}
                        </option selected>
                        @endforeach
                    </select>
                    @error('staffdepartment_id')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-6" class="form-label font-semibold">Desigination</label>
                    <select wire:model.lazy="staffdesignation_id" class="form-select w-full">
                        <option>Select A Designation</option>
                        @foreach ($designation as $key => $value)
                        <option value={{ $value->id }}>
                            {{ $value->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('staffdesignation_id')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-1" class="form-label font-semibold">Gender</label>
                    <select name="gender" wire:model.lazy="gender" id="gender" class="form-select">
                        <option>Select A Gender</option>
                        @foreach (config('archive.gender') as $key => $value)
                        <option value={{ $key }}>
                            {{ $value }}
                        </option>
                        @endforeach
                    </select>
                    @error('gender')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-2" class="form-label font-semibold">E-Mail</label>
                    <input id="input-wizard-2" type="text" class="form-control" wire:model.lazy="email" placeholder="xyz@gmail.com">
                    @error('email')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-3" class="form-label font-semibold">Phone No</label>
                    <input id="input-wizard-2" type="number" class="form-control" wire:model.lazy="phone" placeholder="1234567890">
                    @error('phone')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-2" class="form-label font-semibold">Marital Status</label>
                    <select name="Marital Status" wire:model.lazy="marital_status" id="marital_status" class="form-select">
                        <option>Select A Marital Status</option>
                        @foreach (config('archive.marital_status') as $key => $value)
                        <option value={{ $key }}>
                            {{ $value }}
                        </option>
                        @endforeach
                    </select>
                    @error('marital_status')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-3" class="form-label font-semibold">Date of Birth</label>
                    <input id="input-wizard-2" type="date" class="form-control" wire:model.lazy="dob" placeholder="23-02-1999">
                    @error('dob')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <!-- <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-2" class="form-label font-semibold">Date of Joining</label>
                    <input id="input-wizard-2" type="date" class="form-control" wire:model.lazy="doj"
                        placeholder="23-02-2022">
                    @error('doj')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-1" class="form-label font-semibold">Emerency Number</label>
                    <input id="input-wizard-2" type="number" class="form-control" wire:model.lazy="emerency_number"
                        placeholder="1234567890">
                    @error('emerency_number')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-8">
                    <label for="input-wizard-3" class="form-label font-semibold">Address</label>
                    <textarea id="input-wizard-3" type="text" class="form-control" wire:model.lazy="address"></textarea>
                    @error('address')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div> -->
                <div class="intro-x col-span-12 flex items-center justify-center sm:justify-end mt-5 mb-5">
                    <a href="{{ route('adminstaff') }}" class="btn btn-danger w-24">Cancel</a>
                    <button type="submit" class="btn btn-primary w-24 mx-2 text-center">
                        <div wire:loading>
                            @include('helper.loadingicon.loadingicon')
                        </div>
                        <span wire:loading.remove>Submit</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>