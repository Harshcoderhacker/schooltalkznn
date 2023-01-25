<div>
    <div class="my-8 w-full sm:w-1/6">
        <select wire:model="select_day" class="form-select w-full">
            <option value="1">Today</option>
            <option value="2">Weekly</option>
            <option value="3">Monthly</option>
            <option value="4">Overall</option>
        </select>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-2">
        <div class="col-span-12 sm:col-span-9 grid grid-cols-12 gap-6 mt-2">
            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">

                <div class="box p-5 rounded-lg">
                    <div class="grid grid-cols-12">
                        <div class="col-span-8">
                            <div class="text-sm font-bold">
                                Active Users
                            </div>
                            <div class="text-3xl mt-3 text-primary font-bold">
                                {{ $data[0] }}
                            </div>
                        </div>
                        <div class="text-2xl col-span-4">
                            <img height="65" width="65"
                                src="{{ asset('/image/dashboard/schooltalkz/active_student.png') }}"
                                alt="active_users">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">

                <div wire:click="openinactiveusermodal()" class="box p-5 cursor-pointer rounded-lg">
                    <div class="grid grid-cols-12">
                        <div class="col-span-8">
                            <div class="text-sm font-bold">
                                Inactive Users
                            </div>

                            <div class="text-3xl mt-3 text-danger font-bold">
                                {{ $data[1] }}
                            </div>
                        </div>
                        <div class="text-2xl col-span-4">
                            <img height="65" width="65"
                                src="{{ asset('/image/dashboard/schooltalkz/inactive_student.png') }}"
                                alt="inactive_user">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">

                <div class="box p-5 rounded-lg">
                    <div class="grid grid-cols-12">
                        <div class="col-span-8">
                            <div class="text-sm font-bold">
                                Most Engaged
                            </div>

                            <div class="text-3xl mt-3 text-warning font-bold">
                                {{ $data[2] }}
                            </div>
                        </div>
                        <div class="text-2xl col-span-4">
                            <img height="65" width="65"
                                src="{{ asset('/image/dashboard/schooltalkz/most_engaged.png') }}" alt="most_engaged">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">

                <div class="box p-5 rounded-lg">
                    <div class="grid grid-cols-12">
                        <div class="col-span-8">
                            <div class="text-sm font-bold">
                                No of Posts
                            </div>
                            <div class="text-3xl mt-3 text-primary font-bold">
                                {{ $data[3] }}
                            </div>
                        </div>
                        <div class="text-2xl col-span-4">
                            <img height="65" width="65"
                                src="{{ asset('/image/dashboard/schooltalkz/post.png') }}" alt="no_of_posts">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">

                <div class="box p-5 rounded-lg">
                    <div class="grid grid-cols-12">
                        <div class="col-span-8">
                            <div class="text-sm font-bold">
                                No of Achievements
                            </div>

                            <div class="text-3xl mt-3 text-danger font-bold">
                                {{ $data[4] }}
                            </div>
                        </div>
                        <div class="text-2xl col-span-4">
                            <img height="65" width="65"
                                src="{{ asset('/image/dashboard/schooltalkz/achievements.png') }}"
                                alt="no_of_achievements">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">

                <div class="box p-5 rounded-lg">
                    <div class="grid grid-cols-12">
                        <div class="col-span-8">
                            <div class="text-sm font-bold">
                                No of Polls
                            </div>

                            <div class="text-3xl mt-3 text-warning font-bold">
                                {{ $data[5] }}
                            </div>
                        </div>
                        <div class="text-2xl col-span-4">
                            <img height="65" width="65"
                                src="{{ asset('/image/dashboard/schooltalkz/polls.png') }}" alt="no_of_polls">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-span-12 sm:col-span-3 intro-y mt-2">

            <div class="box p-5 rounded-lg">

                <div class="text-sm my-3 text-center font-bold">
                    Positivity Rate
                </div>
                <div class="my-3.5">
                    @if ($data[6] >= 0 && $data[6] <= 20)
                        <img src="{{ asset('/image/dashboard/schooltalkz/positivity_rate-01.png') }}"
                            alt="positivity_rate">
                    @elseif ($data[6] >= 20 && $data[6] <= 40)
                        <img src="{{ asset('/image/dashboard/schooltalkz/positivity_rate-02.png') }}"
                            alt="positivity_rate">
                    @elseif ($data[6] >= 40 && $data[6] <= 60)
                        <img src="{{ asset('/image/dashboard/schooltalkz/positivity_rate-03.png') }}"
                            alt="positivity_rate">
                    @elseif ($data[6] >= 60 && $data[6] <= 80)
                        <img src="{{ asset('/image/dashboard/schooltalkz/positivity_rate-04.png') }}"
                            alt="positivity_rate">
                    @elseif ($data[6] >= 80 && $data[6] <= 100)
                        <img src="{{ asset('/image/dashboard/schooltalkz/positivity_rate-05.png') }}"
                            alt="positivity_rate">
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6 mt-6 ">
        <div class="col-span-12 sm:col-span-6 bg-white dark:bg-darkmode-600 rounded p-5">
            <div class="flex justify-between">
                <div class="text-primary text-lg font-bold">Class Leaderboard</div>
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
                        @foreach ($classleaderboard as $eachclassleaderboard)
                            <tr>
                                <td>
                                    <div class="w-8 h-8 my-3 rounded-full overflow-hidden shadow-lg image-fit">
                                        @if ($eachclassleaderboard->avatar)
                                            <img alt="{{ $eachclassleaderboard->name }} image" class="rounded-full"
                                                src="{{ url('storage/' . $eachclassleaderboard->avatar) }}">
                                        @else
                                            <img alt="{{ $eachclassleaderboard->name }} image" class="rounded-full"
                                                src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $eachclassleaderboard->name }}</td>
                                <td class="text-primary">{{ $eachclassleaderboard->post_count }} posts</td>
                                <td class="text-warning">{{ $eachclassleaderboard->poll_count }} polls</td>
                                <td class="text-success">
                                    {{ $eachclassleaderboard->gamificationable()->sum('star') }} stars
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div wire:click="openclassleaderboardmodal()"
                    class="text-primary text-md font-bold float-right cursor-pointer">Show
                    more
                </div>
            </div>
        </div>

        <div class="col-span-12 sm:col-span-6 bg-white dark:bg-darkmode-600 rounded p-5">
            <div class="text-primary text-lg font-bold">School Leaderboard</div>
            <div class="mt-5">
                <table class="table-auto w-full">
                    <tbody class="font-bold">
                        @foreach ($schoolleaderboard as $eachschoolleaderboard)
                            <tr>
                                <td>
                                    <div class="w-8 h-8 my-3 rounded-full overflow-hidden shadow-lg image-fit">
                                        @if ($eachschoolleaderboard->avatar)
                                            <img alt="{{ $eachschoolleaderboard->name }} image"
                                                class="rounded-full"
                                                src="{{ url('storage/' . $eachschoolleaderboard->avatar) }}">
                                        @else
                                            <img alt="{{ $eachschoolleaderboard->name }} image"
                                                class="rounded-full"
                                                src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div> {{ $eachschoolleaderboard->name }}</div>
                                    <div class="text-gray-600 font-normal">
                                        {{ $eachschoolleaderboard->classmaster->name }}</div>
                                </td>
                                <td class="text-primary">{{ $eachschoolleaderboard->post_count }} posts</td>
                                <td class="text-warning">{{ $eachschoolleaderboard->poll_count }} polls</td>
                                <td class="text-success">
                                    {{ $eachschoolleaderboard->gamificationable()->sum('star') }} stars</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div wire:click="openschoolleaderboardmodal()"
                    class="text-primary text-md font-bold float-right cursor-pointer">Show
                    more
                </div>

            </div>
        </div>
    </div>

    @include('livewire.admin.dashboard.showinactiveuserrightnav')
    @include('livewire.admin.dashboard.classleaderboardrightnav')
    @include('livewire.admin.dashboard.schoolleaderboardrightnav')
</div>
