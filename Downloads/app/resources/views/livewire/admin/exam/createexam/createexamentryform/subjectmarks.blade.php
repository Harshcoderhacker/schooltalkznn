<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 2 ? '' : 'hidden' }}">
    @include('admin.exam.createexam.helper.createexamformwizard', [
        'active' => 'subjectmarks',
    ])
    <div
        class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none w-full sm:w-10/12 mx-auto">
        <form wire:submit.prevent="validatesubjectmark" autocomplete="off">
            <div class="grid grid-cols-10 gap-4 gap-y-3 mt-3 w-2/3 mx-auto sm:mx-60">
                @foreach ($subjectlist as $subjectkey => $eachsubject)
                    <div class="intro-x col-span-8 sm:col-span-4">
                        <label for="subject_id" class="form-label font-semibold">Subjects</label>
                        <select wire:model="subjectlist.{{ $subjectkey }}.subject_id" wire:key="{{ $loop->index }}"
                            id="subject_id" class="form-select w-full">
                            <option value="0">Select Subject </option>
                            @foreach ($subject->unique('subject_id') as $eachsubject)
                                <option value="{{ $eachsubject->subject->id }}">
                                    {{ $eachsubject->subject->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subjectlist.' . $subjectkey . '.subject_id')
                            <span class="font-semibold text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="intro-x col-span-10 sm:col-span-3 text-center">
                        <label for="mark" class="form-label font-semibold">Mark</label>
                        <input wire:model="subjectlist.{{ $subjectkey }}.mark" wire:keyup="calculatemark()"
                            type="number" class="form-control">
                        @error('subjectlist.' . $subjectkey . '.mark')
                            <span class="font-semibold text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-2 flex gap-2 items-end mb-3">
                        @if ($subjectkey + 1 == sizeof($subjectlist))
                            @include('helper.multientries.add', [
                                'method' => 'addsubject',
                            ])
                        @endif
                        @if ($subjectkey >= 1)
                            @include('helper.multientries.delete', [
                                'method' => 'removesubject',
                                'id' => $subjectkey,
                            ])
                        @endif
                    </div>
                @endforeach
                <div class="intro-x col-span-8 sm:col-span-4 text-right pt-1 mt-2">
                    <label class="form-label font-semibold text-lg">Total</label>
                </div>
                <div class="intro-x col-span-8 sm:col-span-3 mt-2">
                    <input wire:model="total_mark" id="total_mark" type="number" class="form-control" readonly>
                </div>
                <div class="intro-x col-span-10 flex items-center justify-center sm:justify-end mt-5 mb-5">
                    <button type="button" wire:click="back(1)" class="btn btn-secondary w-24">Previous</button>
                    <button type="submit" class="btn btn-primary w-24 ml-2">Next</button>
                </div>
            </div>
        </form>
    </div>
</div>
