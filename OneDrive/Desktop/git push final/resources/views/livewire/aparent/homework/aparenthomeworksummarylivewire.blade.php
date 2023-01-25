<div class="intro-y grid grid-cols-12 gap-5 mt-5">
    <div class="col-span-12 sm:col-span-4 flex lg:block flex-col-reverse">
        <div class="intro-y box mt-5 lg:mt-0">
            <div class="flex items-center p-2 text-lg justify-center bg-primary">
                <h1 class="font-semibold text-white">Home Summary</h1>
            </div>
            <div class="p-3 border-t grid grid-cols-12 border-gray-200 dark:border-dark-5">
                <div class="col-span-12 sm:col-span-6 flex flex-row mt-5">
                    <button class="rounded-full w-10 h-10 text-center" style="background-color: #E4FCD8">
                        <svg xmlns="http://www.w3.org/2000/svg" style="color: #44BD32;" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-home w-5 h-5 mx-auto">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </button>
                    <span class="mt-auto mb-auto mx-3">Class <br>
                        <span class="font-semibold text-base">
                            {{ $homework->classmaster->name }}
                        </span>
                    </span>
                </div>
                <div class="col-span-12 sm:col-span-6 flex flex-row mt-5">
                    <button class="rounded-full w-10 h-10" style="background-color: #E4FCD8">
                        <svg xmlns="http://www.w3.org/2000/svg" style="color: #44BD32" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-star w-5 h-5 mx-auto">
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                            </polygon>
                        </svg>
                    </button>
                    <span class="mt-auto mb-auto mx-3">Section<br>
                        <span class="font-semibold text-base">
                            {{ $homework->section->name }}
                        </span>
                    </span>
                </div>
                <div class="col-span-12 sm:col-span-6 flex flex-row mt-5">
                    <button class="rounded-full w-10 h-10" style="background-color: #E4FCD8">
                        <svg xmlns="http://www.w3.org/2000/svg" style="color: #44BD32" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-align-center w-5 h-5 mx-auto">
                            <line x1="18" y1="10" x2="6" y2="10"></line>
                            <line x1="21" y1="6" x2="3" y2="6"></line>
                            <line x1="21" y1="14" x2="3" y2="14"></line>
                            <line x1="18" y1="18" x2="6" y2="18"></line>
                        </svg>
                    </button>
                    <span class="mt-auto mb-auto mx-3">Subject <br>
                        <span class="font-semibold text-base">
                            {{ $homework->assignsubject->subject?->name }}
                        </span>
                    </span>
                </div>
                <div class="col-span-12 sm:col-span-6 flex flex-row mt-5">
                    <button class="rounded-full w-10 h-10" style="background-color: #E4FCD8">
                        <svg xmlns="http://www.w3.org/2000/svg" style="color: #44BD32" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user w-5 h-5 mx-auto">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </button>
                    <span class="mt-auto mb-auto mx-3">Created by<br>
                        <span class="font-semibold text-base">
                            {{ $homework->created_by }}
                            <small> ({{ $homework->usertype }}) </small>
                        </span>
                    </span>
                </div>
                <div class="col-span-12 flex flex-row mt-5">
                    <button class="rounded-full w-10 h-10" style="background-color: #E2EEFF">
                        <svg xmlns="http://www.w3.org/2000/svg" style="color: #0663DF" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-calendar w-5 h-5 mx-auto">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </button>
                    <span class="mt-auto mb-auto mx-3">Created on<br>
                        <span class="font-semibold text-base">
                            {{ \Carbon\Carbon::parse($homework->created_at)->format('F, d Y') }}
                        </span>
                    </span>
                </div>
                <div class="col-span-12 flex flex-row mt-5">
                    <button class="rounded-full w-10 h-10" style="background-color: #FFE8E8">
                        <svg xmlns="http://www.w3.org/2000/svg" style="color: #D22525" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-calendar w-5 h-5 mx-auto">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </button>
                    <span class="mt-auto mb-auto mx-3">Due On <br>
                        <span class="font-semibold text-base">
                            {{ \Carbon\Carbon::parse($homework->due_date)->format('F, d Y') }}
                        </span>
                    </span>
                </div>
            </div>
            <div class="col-span-12 mt-5 w-11/12 mx-auto rounded-lg" style="background-color: #E8F1FF">
                <div class="grid grid-cols-12 gap-5 p-3 mx-auto">
                    <div class="col-span-12 sm:col-span-6" style="color: #0663DF">Marks <br>
                        <span class="font-semibold text-base">
                            {{ $homework->marks }}
                        </span>
                    </div>
                    <div class="col-span-12 sm:col-span-6" style="color: #DF0606">My Score<br>
                        <span class="font-semibold text-base">
                            {{ $marks ? $marks : '' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="p-2 mb-4 border w-11/12 mx-auto rounded-lg border-gray-200 dark:border-dark-5 mt-5">
                <div class="grid grid-cols-12 gap-5 p-3">
                    <div class="col-span-12">Title<br>
                        <span class="font-semibold text-base">
                            {{ $homework->title }}
                        </span>
                    </div>
                    <div class="col-span-12">Description<br>
                        <span class="font-semibold text-base">
                            {{ $homework->description }}
                        </span>
                    </div>
                    <div class="col-span-12 whitespace-wrap">Attachment
                        @if ($homework->attachment)
                            <div class="flex font-semibold text-base ">
                                Homework Attachment
                                <button class="px-2" wire:click="downloadhomeworkattachment">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-download">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                </button>
                            </div>
                        @else
                            <div class="flex font-semibold text-base px-6">
                                <span class="text-red-600 ">-</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
    <div class="col-span-12 sm:col-span-8 lg:block">
        @if ($homeworklist->homework_status == false && $homeworklist->submissionfile)
            <h4 class="text-center text-red-600">Redo the Homework again</h4>
        @endif
        <div class="border relative mt-3 rounded intro-x shadow-md mb-3 dark:text-white intro-x">
            <input wire:model="submissionfile" type="file"
                class="cursor-pointer relative block opacity-0 w-full h-full p-20 z-50">
            <div class="text-center p-10 absolute top-0 right-0 left-0 m-auto">
                @if ($homeworklist->homework_status == false)
                    <h4>
                        Drop files anywhere to upload
                        <br />or
                    </h4>
                    <p class="">Select Files</p>
                @else
                    <h4>
                        You Already submitted your Homework
                    </h4>
                @endif
            </div>
            @error('submissionfile')
                <span class="font-semibold text-red-600 mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="intro-y box mt-5">
            @livewire('aparent.homework.homeworkcomments.aparenthomeworkcommentlivewire', ['homeworkid' =>
            $homework->id])
        </div>
    </div>
</div>
