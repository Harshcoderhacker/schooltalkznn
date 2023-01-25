<div>
    <div class="col-span-12">
        @include('helper.reload.reload')
        <div class="w-full mx-auto sm:w-5/6">
            <div class="grid grid-cols-12 gap-6 mt-2">
                <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5 rounded-lg" style="background-color: #6C5CE7">
                            <div class="flex flex-row text-white font-bold">
                                <div class="text-xl mt-auto mb-auto">
                                    Today's <br> Homework
                                </div>
                                <span class="ml-auto text-4xl mt-auto mb-auto">
                                    {{ $count }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5 rounded-lg" style="background-color: #FDCB6E">
                            <div class="flex flex-row text-white font-bold">
                                <div class="text-xl mt-auto mb-auto">
                                    Homework <br> Completion
                                </div>
                                <span class="ml-auto text-4xl mt-auto mb-auto">
                                    {{ $completionpercentage }} %
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5 rounded-lg" style="background-color: #00B894">
                            <div class="flex flex-row text-white font-bold">
                                <div class="text-xl mt-auto mb-auto">
                                    Top Performing <br> Class
                                </div>
                                <span class="ml-auto text-4xl mt-auto mb-auto">
                                    V
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 mt-8">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Search Homework</h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2">
            <div class="col-span-12 sm:col-span-3 intro-y">
                <select class="form-select text-xs sm:text-sm" wire:model="classmaster_id">
                    <option value="0">Select A Class</option>
                    @foreach ($allclassmaster as $key => $value)
                    <option value={{ $value->id }}>
                        {{ $value->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 sm:col-span-3 intro-y">
                <select class="form-select text-xs sm:text-sm" wire:model="section_id">
                    <option class="text-xs sm:text-sm">Select A Section</option>
                    @foreach ($section as $eachsection)
                    <option value="{{ $eachsection->id }}">
                        {{ $eachsection->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 sm:col-span-3 intro-y">
                <select class="form-select text-xs sm:text-sm" wire:model="assignsubject_id">
                    <option class="text-xs sm:text-sm">Select A Subject</option>
                    @foreach ($allassignsubject as $eachsubject)
                    <option value="{{ $eachsubject->id }}">
                        {{ $eachsubject->subject?->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 sm:col-span-3 intro-y">
                <button wire:click="createhomeworkmodal" class="btn btn-primary w-full">Create Homework</button>
            </div>
        </div>
    </div>
    @if ($homeworklist->isNotEmpty())
    <div class="flex flex-col mt-8 intro-y">
        <div class="mx-3">
            <div class="-my-2 overflow-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2  align-middle inline-block min-w-full  sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="table  table-report -mt-2">
                            <thead class="bg-primary">
                                <tr class="intro-x">
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Class
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Section
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Subject
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Created Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Due Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Marks
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Evaluation Percentage
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-semibold text-white uppercase tracking-wider text-left">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($homeworklist as $eachhomework)
                                <tr class="intro-x">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            {{ $eachhomework->classmaster->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            {{ $eachhomework->section->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            {{ $eachhomework->assignsubject->subject?->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            {{ $eachhomework->title }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            {{ \Carbon\Carbon::parse($eachhomework->created_at)->format('F, d Y') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            {{ \Carbon\Carbon::parse($eachhomework->due_date)->format('F, d Y') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            {{ $eachhomework->marks }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            0
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($platform == 'admin')
                                        <a href="{{ route('adminhomeworksummary', $eachhomework->uuid) }}"
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full text-green-600">
                                            View Data
                                        </a>
                                        @elseif($platform == 'staff')
                                        <a href="{{ route('staffhomeworksummary', $eachhomework->uuid) }}"
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full text-green-600">
                                            View Data
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('helper.datatable.pagination', ['pagination' => $homeworklist])
    @else
    @include('helper.datatable.norecordfound')
    @endif
    @if ($createhomeworkmodal)
    <div class="fixed inset-0 z-50 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <div
        class="right-0 left-0 z-50 justify-center mt-2 sm:mt-8 min-h-min inset-0 fixed pin overflow-auto bg-smoke-dark flex">
        <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-3/5 shadow-2xl">
            <div class="flex justify-between items-center sm:p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                <h3 class="text-md p-2 sm:text-lg font-semibold text-white">
                    Homework
                </h3>
                <button wire:click="closecreatehomeworkmodal"
                    class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="defaultModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <form wire:submit.prevent="createorupdatehomework" autocomplete="off">
                <div class="modal-body grid grid-cols-12 gap-2 gap-y-0 sm:gap-4 sm:gap-y-3">
                    <div class="col-span-12 sm:col-span-12">
                        <label for="title" class="form-label font-bold text-xs sm:text-sm">Title</label>
                        <input id="title" wire:model.lazy="title" type="text" class="form-control">
                        @error('title')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <label for="classmaster" class="form-label font-bold text-xs sm:text-sm">Class</label>
                        <select class="form-select text-xs sm:text-sm" wire:model="classmaster_id" id="classmaster">
                            <option value="0">Select A Class</option>
                            @foreach ($allclassmaster as $key => $value)
                            <option value={{ $value->id }}>
                                {{ $value->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('classmaster_id')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <label for="section" class="form-label font-bold text-xs sm:text-sm">Section</label>
                        <select class="form-select text-xs sm:text-sm" wire:model="section_id" id="section">
                            <option value="0">Select A Section</option>
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
                    <div class="col-span-6 sm:col-span-4">
                        <label for="subject" class="form-label font-bold text-xs sm:text-sm">Subject</label>
                        <select class="form-select text-xs sm:text-sm" wire:model="assignsubject_id" id="subject">
                            <option class="text-xs sm:text-sm">Select A Subject</option>
                            @foreach ($allassignsubject as $eachsubject)
                            <option value="{{ $eachsubject->id }}">
                                {{ $eachsubject->subject?->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('assignsubject_id')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <label for="due_date" class="form-label font-bold text-xs sm:text-sm">Due Date</label>
                        <input id="due_date" wire:model.lazy="due_date" type="date" class="form-control">
                        @error('due_date')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <label for="marks" class="form-label font-bold text-xs sm:text-sm">Marks</label>
                        <input id="marks" wire:model.lazy="marks" type="number" class="form-control">
                        @error('marks')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4 text-xs mt-1 sm:text-sm">
                        <label for="attachment" class="form-label font-bold text-xs sm:text-sm">Attachments</label>
                        <input id="attachment" wire:model.lazy="attachment" type="file">
                        @error('attachment')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                        <label for="description" class="form-label font-bold text-xs sm:text-sm">Description</label>
                        <textarea rows="3" wire:model.lazy="description" class="form-control font-bold"></textarea>
                        @error('description')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div
                    class="flex flex-row-reverse items-center sm:p-3 sm:gap-2  rounded-b border-t border-gray-200 dark:border-gray-600">
                    <button type="button" wire:click="closecreatehomeworkmodal"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="btn btn-primary text-xs sm:text-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>