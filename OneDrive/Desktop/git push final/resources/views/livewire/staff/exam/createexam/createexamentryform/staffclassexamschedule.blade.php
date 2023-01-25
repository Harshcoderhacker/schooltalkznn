<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 3 ? '' : 'hidden' }}">
    @include(
        'staff.exam.staffcreateexam.helper.staffcreateexamformwizard',
        ['active' => 'classexamschedule']
    )
    <div
        class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none w-full sm:w-10/12 mx-auto">
        <form wire:submit.prevent="validateexamschedule" autocomplete="off">
            <div class="grid grid-cols-10 gap-4 gap-y-10 mt-3">
                <div class="intro-x col-span-9 sm:col-span-3">
                    <label for="input-wizard-1" class="form-label font-semibold">Subject</label>
                </div>
                <div class="intro-x col-span-9 sm:col-span-3 text-center">
                    <label for="input-wizard-2" class="form-label font-semibold">Date</label>
                </div>
                <div class="intro-x col-span-9 sm:col-span-2 text-center">
                    <label for="input-wizard-2" class="form-label font-semibold">Start Time</label>
                </div>
                <div class="intro-x col-span-9 sm:col-span-2 text-center">
                    <label for="input-wizard-2" class="form-label font-semibold">End Time</label>
                </div>
                @foreach ($subjectlist as $key => $eachsubject)
                    <div class="intro-x col-span-9 sm:col-span-3">
                        <span
                            class="inline-flex text-base leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                            {{ isset($eachsubject['subject_name']) ? $eachsubject['subject_name'] : '' }}
                        </span>
                    </div>
                    <div class="intro-x col-span-9 sm:col-span-3 text-center">
                        <input wire:model="subjectlist.{{ $key }}.date" type="date" class="form-control">
                        @error('subjectlist.' . $key . '.date')
                            <span class="font-semibold text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="intro-x col-span-9 sm:col-span-2 text-center">
                        <input wire:model="subjectlist.{{ $key }}.start_time" type="time"
                            class="form-control">
                        @error('subjectlist.' . $key . '.start_time')
                            <span class="font-semibold text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="intro-x col-span-9 sm:col-span-2 text-center">
                        <input wire:model="subjectlist.{{ $key }}.end_time" type="time" class="form-control">
                        @error('subjectlist.' . $key . '.end_time')
                            <span class="font-semibold text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach
                <div class="intro-x col-span-9 flex items-center justify-center sm:justify-end mt-5 mb-5">
                    <button type="button" wire:click="back(2)" class="btn btn-secondary w-24">Previous</button>
                    <button type="submit" class="btn btn-primary w-24 ml-2">Next</button>
                </div>
            </div>
        </form>
    </div>
</div>
