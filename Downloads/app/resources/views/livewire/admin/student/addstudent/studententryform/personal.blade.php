<div class="intro-x box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 1 ? '' : 'hidden' }}">
    @include('admin.student.helper.addstudentformwizard', [
    'active' => 'personal',
    ])
    <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
        <form wire:submit.prevent="createorupdate" autocomplete="off">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-x col-span-12 sm:col-span-4 xl:col-span-4">
                    <label for="academic_year" class="form-label font-semibold">Academic Year</label>
                    <select class="form-select" wire:model.lazy="academicyear_id">
                        <option>Select A Academic Year</option>
                        @foreach ($allacademicyear as $key => $value)
                        <option value={{ $value->id }}>
                            {{ $value->year }}
                        </option>
                        @endforeach
                    </select>
                    @error('academicyear_id')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4 xl:col-span-4">
                    <label for="class" class="form-label font-semibold">Class</label>
                    <select class="form-select" wire:model.lazy="classmasterid">
                        <option>Select A Class</option>
                        @foreach ($allclassmaster as $key => $value)
                        <option value={{ $value->id }}>
                            {{ $value->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('classmasterid')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4 xl:col-span-4">
                    <label for="section" class="form-label font-semibold">Section</label>
                    <select class="form-select" wire:model.lazy="section_id">
                        <option>Select A Section</option>
                        @foreach ($section as $eachsection)
                        <option value="{{ $eachsection->id }}">
                            {{ $eachsection->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('section_id')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <!-- <div class="intro-x col-span-12 sm:col-span-4 xl:col-span-4">
                    <label for="addmission_number" class="form-label font-semibold">Admission Number</label>
                    <input id="addmission_number" wire:model.lazy="addmission_number" type="text" class="form-control">
                    @error('addmission_number')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div> -->
                <div class="intro-x col-span-12 sm:col-span-4 xl:col-span-4">
                    <label for="roll_no" class="form-label font-semibold">Roll No</label>
                    <input id="roll_no" wire:model.lazy="roll_no" type="text" class="form-control">
                    @error('roll_no')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4 xl:col-span-4">
                    <label for="gender" class="form-label font-semibold">Gender</label>
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
                <div class="intro-x col-span-12 sm:col-span-4 xl:col-span-4">
                    <label for="name" class="form-label font-semibold">First Name</label>
                    <input wire:model.lazy="name" type="text" class="form-control">
                    @error('name')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4 xl:col-span-4">
                    <label for="last_name" class="form-label font-semibold">Last Name</label>
                    <input id="last_name" wire:model.lazy="last_name" type="text" class="form-control">
                    @error('last_name')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4 xl:col-span-4">
                    <label for="dob" class="form-label font-semibold">Date of Birth</label>
                    <input id="dob" wire:model.lazy="dob" type="date" class="form-control">
                    @error('dob')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4 xl:col-span-4">
                    <label for="phone_no" class="form-label font-semibold">Phone No.</label>
                    <input id="phone_no" wire:model.lazy="phone_no" type="number" class="form-control">
                    @error('phone_no')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4 xl:col-span-4">
                    <label for="email" class="form-label font-semibold">E-Mail</label>
                    <input id="email" wire:model.lazy="email" type="text" class="form-control">
                    @error('email')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <!-- <div class="intro-x col-span-12 sm:col-span-4 xl:col-span-4">
                    <label for="blood_group" class="form-label font-semibold">Blood Group</label>
                    <select class="form-select" wire:model.lazy="blood_group">
                        <option>Select A Blood Group</option>
                        @foreach (config('archive.blood_group') as $key => $value)
                        <option value={{ $key }}>
                            {{ $value }}
                        </option>
                        @endforeach
                    </select>
                    @error('blood_group')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4 xl:col-span-4">
                    <label for="religion" class="form-label font-semibold">Religion</label>
                    <select class="form-select" wire:model.lazy="religion">
                        <option>Select Religion</option>
                        @foreach (config('archive.religion') as $key => $value)
                        <option value={{ $key }}>
                            {{ $value }}
                        </option>
                        @endforeach
                    </select>
                    @error('religion')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4 xl:col-span-4">
                    <label for="emis_number" class="form-label font-semibold">EMIS Number</label>
                    <input id="emis_number" wire:model.lazy="emis_number" type="text" class="form-control">
                    @error('emis_number')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="address" class="form-label font-semibold">Address</label>
                    <textarea id="address" wire:model.lazy="address" type="text" class="form-control"></textarea>
                    @error('address')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                -->
                <div class="intro-x col-span-12 flex items-center justify-center sm:justify-end mt-5 mb-5">
                    <a href="{{ route('adminstudent') }}" class="btn btn-danger w-24">Cancel</a>
                    <button type="submit" class="btn btn-primary w-24 mx-2 text-center">
                        <div wire:loading>
                            @include('helper.loadingicon.loadingicon')
                        </div>
                        <span wire:loading.remove>Next</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>