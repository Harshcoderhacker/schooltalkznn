<div>
    <div class="p-3 grid grid-cols-12 border-gray-200 dark:border-dark-5">
        <div class="col-span-12 sm:col-span-12 flex flex-col mt-5">
            <label class="form-label font-semibold text-xl">Question {{ $questionno }}
            </label>
            <span class="mx-3 leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                {{ $questionno }}. {{ $onlineassessmentquestion->question }}</span>
        </div>
    </div>
    <div class="p-3 grid grid-cols-12 border-gray-200 dark:border-dark-5">
        <div class="col-span-12 sm:col-span-12 flex flex-col mt-5">
            <label class="form-label font-semibold text-xl">Answer</label>
            <div class="flex flex-col gap-4">
                <div>
                    @php
                        $rad = rand();
                    @endphp
                    <input {{ $answer == 1 ? 'checked' : '' }} name="radio_{{ $onlineassessmentquestion->id }}"
                        id="{{ $rad }}" type="radio" class="w-4 mx-4" wire:click="markanswer(1)">
                    <label for="{{ $rad }}"
                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                        {{ $onlineassessmentquestion->option_one }}
                    </label>
                </div>
                <div>
                    @php
                        $rad = rand();
                    @endphp
                    <input {{ $answer == 2 ? 'checked' : '' }} name="radio_{{ $onlineassessmentquestion->id }}"
                        id="{{ $rad }}" type="radio" class="w-4 mx-4" wire:click="markanswer(2)">
                    <label for="{{ $rad }}"
                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                        {{ $onlineassessmentquestion->option_two }}
                    </label>
                </div>
                <div>
                    @php
                        $rad = rand();
                    @endphp
                    <input {{ $answer == 3 ? 'checked' : '' }} name="radio_{{ $onlineassessmentquestion->id }}"
                        id="{{ $rad }}" type="radio" class="w-4 mx-4" wire:click="markanswer(3)">
                    <label for="{{ $rad }}"
                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                        {{ $onlineassessmentquestion->option_three }}
                    </label>
                </div>
                <div>
                    @php
                        $rad = rand();
                    @endphp
                    <input {{ $answer == 4 ? 'checked' : '' }} name="radio_{{ $onlineassessmentquestion->id }}"
                        id="{{ $rad }}" type="radio" class="w-4 mx-4" wire:click="markanswer(4)">
                    <label for="{{ $rad }}"
                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                        {{ $onlineassessmentquestion->option_four }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
