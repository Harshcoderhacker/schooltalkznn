<div>
    <div class="intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 sm:col-span-4 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5 lg:mt-0">
                <div class="flex items-center p-2 text-lg justify-center bg-primary">
                    <h1 class="font-semibold text-white">Exam Details</h1>
                </div>
                <div class="p-3 border-t grid grid-cols-12 border-gray-200 dark:border-dark-5">
                    <div class="col-span-12 sm:col-span-6 flex flex-row mt-5">
                        <button class="rounded-full w-10 h-10" style="background-color: #E4FCD8">
                            <i data-feather="home" class="w-5 h-5 mx-auto" style="color: #44BD32"></i>
                        </button>
                        <span class="mt-auto mb-auto mx-3">Exam Name <br>
                            <span class="font-semibold text-base">
                                {{ $onlineassessment->name }}
                            </span>
                        </span>
                    </div>
                    <div class="col-span-12 sm:col-span-6 flex flex-row mt-5">
                        <button class="rounded-full w-10 h-10" style="background-color: #E4FCD8">
                            <i data-feather="align-center" class="w-5 h-5 mx-auto" style="color: #44BD32"></i>
                        </button>
                        <span class="mt-auto mb-auto mx-3">Subject <br>
                            <span class="font-semibold text-base">
                                {{ $onlineassessment->subject->name }}
                            </span>
                        </span>
                    </div>
                    <div class="col-span-12 flex flex-row mt-5">
                        <button class="rounded-full w-10 h-10" style="background-color: #E2EEFF">
                            <i data-feather="calendar" class="w-5 h-5 mx-auto" style="color: #0663DF"></i>
                        </button>
                        <span class="mt-auto mb-auto mx-3">Created on<br>
                            <span class="font-semibold text-base">
                                {{ $onlineassessment->created_at->format('d-M-Y') }}
                            </span>
                        </span>
                    </div>
                    <div class="col-span-12 flex flex-row mt-5">
                        <button class="rounded-full w-10 h-10" style="background-color: #FFE8E8">
                            <i data-feather="calendar" class="w-5 h-5 mx-auto" style="color: #D22525"></i>
                        </button>
                        <span class="mt-auto mb-auto mx-3">Due On <br>
                            <span class="font-semibold text-base">
                                {{ $onlineassessment->end_date ? $onlineassessment->end_date->format('d-M-Y') : 'Always Active' }}
                            </span>
                        </span>
                    </div>
                </div>
                <div class="col-span-12 mt-5 w-11/12 mx-auto rounded-lg" style="background-color: #E8F1FF">
                    <div class="grid grid-cols-12 gap-5 p-3 mx-auto">
                        <div class="col-span-12 sm:col-span-6" style="color: #0663DF">Marks <br>
                            <span class="font-semibold text-base">
                                {{ $onlineassessment->total_mark }}
                            </span>
                        </div>
                        <div class="col-span-12 sm:col-span-6" style="color: #DF0606">My Score<br>
                            <span class="font-semibold text-base">
                                {{ $completion == true ? $onlineassessmentstudentlist->mark : '' }}
                            </span>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
        @if ($completion == false)
            <div class="col-span-12 sm:col-span-8 flex lg:block flex-col-reverse">
                <div class="intro-y box mt-5 lg:mt-0">
                    <div class="p-2">
                        @foreach ($onlineassessment->onlineassessmentquestion as $key => $eachonlineassessmentquestion)
                            <div {{ $current_question == $key ? '' : 'hidden' }}>
                                @livewire('aparent.exam.onlineassessment.parenttakeonlineassessmentlivewire',[
                                'onlineassessmentquestion'=>$eachonlineassessmentquestion,
                                'questionno'=>$key+1,
                                ],key($eachonlineassessmentquestion->id))
                            </div>
                        @endforeach
                        <div class="p-3 grid grid-cols-12 border-gray-200 dark:border-dark-5">
                            <div class="col-span-12 sm:col-span-12 flex gap-2 flex-row-reverse mt-2">
                                @if ($current_question + 1 == sizeof($onlineassessment->onlineassessmentquestion))
                                    <button class="btn btn-primary w-auto" wire:click="submitassessment">Submit</button>
                                @else
                                    <button class="btn btn-primary w-auto" wire:click="nextquestion">Next</button>
                                @endif
                                @if ($current_question > 0)
                                    <button class="btn btn-warning w-auto"
                                        wire:click="previousquestion">Previous</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        @else
            <div class="col-span-12 sm:col-span-8 mx-auto my-auto">
                Completed Assessment Successfully!
                <div class="text-right mt-3">
                    <a class="underline" href="{{ route('parentonliveonlineassesment') }}">back</a>
                </div>

            </div>
        @endif
    </div>
</div>
