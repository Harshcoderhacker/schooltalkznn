<div>
    <div class="grid grid-cols-12 gap-6 mt-2">
        <div class="col-span-12 sm:col-span-12 grid grid-cols-12 gap-6 mt-2">
            <div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y">
                <div class="box p-5 rounded-lg">
                    <div class="flex justify-end my-1 gap-3">
                        <div>
                            <select wire:model="emotionselectedday" class="form-select w-full">
                                <option value="1">Today</option>
                                <option value="2">Weekly</option>
                                <option value="3">Monthly</option>
                                <option value="4">Overall</option>
                            </select>
                        </div>
                        <div>
                            <div>
                                <select wire:model="classemotionfilter" class="form-select">
                                    <option value="0">Overall</option>
                                    @foreach ($classmaster as $eachclassmaster)
                                    <option value="{{ $eachclassmaster->id }}">{{ $eachclassmaster->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row justify-around gap-4 mt-4">
                        <div>
                            <div class="flex flex-col">
                                <div class="font-semibold text-md text-center">
                                    Happy
                                </div>
                                <div type="button" wire:click="openstudentfellingmodal(1)" class="cursor-pointer">
                                    <img class="h-20 object-contain w-auto mx-auto img-fluid sm:h-28 sm:auto"
                                        src="{{ asset('/image/dashboard/emotioncapture/happy.png') }}"
                                        alt="active_users">
                                </div>
                                <div class="text-green-400 font-semibold sm:text-lg lg:text-3xl md:text-xl text-center">
                                    {{ $emotions->where('emotionstatus', 1)->count() != 0 ?
                                    number_format(($emotions->where('emotionstatus', 1)->count() /
                                    $noofstudents->count()) * 100, 2) : 0 }}
                                    %
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex flex-col">
                                <div class="font-semibold text-md text-center">
                                    Excited
                                </div>
                                <div type="button" wire:click="openstudentfellingmodal(2)" class="cursor-pointer">
                                    <img class="h-20 object-contain w-auto mx-auto img-fluid sm:h-28 sm:auto"
                                        src="{{ asset('/image/dashboard/emotioncapture/excited.png') }}"
                                        alt="active_users">
                                </div>
                                <div
                                    class="text-purple-600 font-semibold sm:text-lg lg:text-3xl md:text-xl text-center">
                                    {{ $emotions->where('emotionstatus', 2)->count() != 0 ?
                                    number_format(($emotions->where('emotionstatus', 2)->count() /
                                    $noofstudents->count()) * 100, 2) : 0 }}
                                    %
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex flex-col">
                                <div class="font-semibold text-md text-center">
                                    Neutral
                                </div>
                                <div type="button" wire:click="openstudentfellingmodal(3)" class="cursor-pointer">
                                    <img class="h-20 object-contain w-auto mx-auto img-fluid sm:h-28 sm:auto"
                                        src="{{ asset('/image/dashboard/emotioncapture/neutral.png') }}"
                                        alt="active_users">
                                </div>
                                <div
                                    class="text-orange-600 font-semibold sm:text-lg lg:text-3xl md:text-xl text-center">
                                    {{ $emotions->where('emotionstatus', 3)->count() != 0 ?
                                    number_format(($emotions->where('emotionstatus', 3)->count() /
                                    $noofstudents->count()) * 100, 2) : 0 }}
                                    %
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex flex-col">
                                <div class="font-semibold text-md text-center">
                                    Scared
                                </div>
                                <div type="button" wire:click="openstudentfellingmodal(4)" class="cursor-pointer">
                                    <img class="h-20 object-contain w-auto mx-auto img-fluid sm:h-28 sm:auto"
                                        src="{{ asset('/image/dashboard/emotioncapture/scared.png') }}"
                                        alt="active_users">
                                </div>
                                <div class="text-red-600 font-semibold sm:text-lg lg:text-3xl md:text-xl text-center">
                                    {{ $emotions->where('emotionstatus', 4)->count() != 0 ?
                                    number_format(($emotions->where('emotionstatus', 4)->count() /
                                    $noofstudents->count()) * 100, 2) : 0 }}
                                    %
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex flex-col">
                                <div class="font-semibold text-md text-center">
                                    Disturbed
                                </div>
                                <div type="button" wire:click="openstudentfellingmodal(5)" class="cursor-pointer">
                                    <img class="h-20 object-contain w-auto mx-auto img-fluid sm:h-28 sm:auto "
                                        src="{{ asset('/image/dashboard/emotioncapture/stressed.png') }}"
                                        alt="active_users">
                                </div>
                                <div class="text-green-600 font-semibold sm:text-lg lg:text-3xl md:text-xl text-center">
                                    {{ $emotions->where('emotionstatus', 5)->count() != 0 ?
                                    number_format(($emotions->where('emotionstatus', 5)->count() /
                                    $noofstudents->count()) * 100, 2) : 0 }}
                                    %
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-8 w-full sm:w-1/6">
        <select wire:model="select_day" class="form-select w-full">
            <option value="1">Today</option>
            <option value="2">Weekly</option>
            <option value="3">Monthly</option>
            <option value="4">Overall</option>
        </select>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-6 ">
        <div class="col-span-12 sm:col-span-6 bg-white dark:bg-darkmode-600 rounded p-5">
            <div class="flex justify-between">
                <div class="text-primary text-lg font-bold">Student Needing Attention</div>
                <div>
                    <select wire:model="classmaster_id" class="form-select">
                        @foreach ($classmaster as $eachclassmaster)
                        <option value="{{ $eachclassmaster->id }}">{{ $eachclassmaster->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-5">
                <table class="table-auto w-full">
                    <tbody class="font-bold">
                        @foreach ($studentsneedsattention as $key => $value)
                        @if ($key < 3) <tr>
                            @if ($value->distrubed || $value->scared)
                            <td>
                                <div class="w-8 h-8 my-3 rounded-full overflow-hidden shadow-lg image-fit">
                                    @if ($value->avatar)
                                    <img alt="{{ $value->name }} image" class="rounded-full"
                                        src="{{ url('storage/' . $value->avatar) }}">
                                    @else
                                    <img alt="image" class="rounded-full"
                                        src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                    @endif
                                </div>
                            </td>
                            <td class="font-medium">{{ $value->name }}</td>
                            <td class="flex justify-between mt-4">
                                <span {{ $value->distrubed ? '' : 'hidden' }} class="text-red-500 ">
                                    @if ($select_day == 1)
                                    Distributed Today
                                    @else
                                    Distributed for {{ $value->distrubed }} days
                                    @endif
                                </span>
                                <span {{ $value->scared ? '' : 'hidden' }} class="text-purple-500">
                                    @if ($select_day == 1)
                                    Scared Today
                                    @else
                                    Scared for {{ $value->scared }} days
                                    @endif
                                </span>
                            </td>
                            @endif
                            </tr>
                            @endif
                            @endforeach
                    </tbody>
                </table>

                <div wire:click="openstudentneedattentionmodal()"
                    class="text-primary text-xs flex flex-row gap-1 justify-center content-center font-bold float-right cursor-pointer border border-primary text-center p-1 w-28 rounded-full ">
                    Show More <span class="my-auto"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                        </svg></span>
                </div>
            </div>
        </div>

        <div class="col-span-12 sm:col-span-6 bg-white dark:bg-darkmode-600 rounded p-5">
            <div class="text-primary text-lg font-bold">Classes needing Attention</div>
            <div class="mt-5">
                <div class="w-full flex flex-col gap-3">
                    @foreach ($classneedsattentioncount as $key => $value)
                    @if ($key < 5) <div
                        class="bg-gradient-to-r from-[#fcefd4] via-[#feefd0] to-[#faefd5]  flex flex-row justify-around p-3">
                        <div class="text-green-600 font-medium">
                            {{ $classmaster->find($value)->name }}
                        </div>
                        @if ($this->disturbed)
                        <div class="text-purple-500 font-semibold">
                            {{ $this->disturbed[$value] }} Students are scared
                        </div>
                        @endif
                        @if ($this->scared)
                        <div class="text-red-500 font-semibold">
                            {{ $this->scared[$value] }} Students are depressed
                        </div>
                        @endif
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('livewire.admin.dashboard.studentneedattentionrightnav')
@include('livewire.admin.dashboard.studentfeelinghappyrightnav')
{{-- @include('livewire.admin.dashboard.studentfeelingdisturbedrightnav') --}}
</div>