<div>
    <div class="col-span-12">
        <div class="intro-y flex items-center h-10">
            <a href="" class="ml-auto flex items-center text-theme-1 dark:text-theme-10">
                <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
            </a>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2">
            <div class="col-span-12 sm:col-span-4 intro-y">
                <select wire:model="assignsubject_id" class="form-select w-full mt-5">
                    <option value="0">Select Subject </option>
                    @foreach ($subjects as $eachassignsub)
                        <option value="{{ $eachassignsub->subject->id }}">
                            {{ $eachassignsub->subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-xl font-medium truncate mr-5">Recent Homework</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($homework->isNotEmpty())
        <div class="grid grid-cols-12 gap-1 mt-4">
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead class="bg-primary">
                        <tr class="intro-x">
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Subject
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Title
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Created Date
                                </div>
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Due Date
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Marks
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Your Marks
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($homework as $index => $value)
                            <tr class="intro-x">
                                <td>
                                    <span class="text-sm font-medium whitespace-nowrap">
                                        {{ $value->assignsubject->subject?->name }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm font-medium whitespace-nowrap">
                                        {{ $value->title }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm font-medium whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($value->created_at)->format('F, d Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm font-medium whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($value->due_date)->format('F, d Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm font-medium whitespace-nowrap">
                                        {{ $value->marks }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm font-medium whitespace-nowrap">
                                        {{ $value->homeworklist[0]?->marks }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('homeworksummary', $value->id) }}"
                                        class="text-sm font-medium text-center" style="color:rgb(0, 221, 0)">
                                        View Homework
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('helper.datatable.pagination', ['pagination' => $homework])
    @else
        @include('helper.datatable.norecordfound')
    @endif
</div>
