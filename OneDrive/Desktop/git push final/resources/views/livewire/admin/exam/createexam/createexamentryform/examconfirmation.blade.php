<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 4 ? '' : 'hidden' }}">
    @include('admin.exam.createexam.helper.createexamformwizard', [
        'active' => 'examconfig',
    ])
    <div
        class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none w-full sm:w-8/12 mx-auto">
        <form wire:submit.prevent="submitexam" autocomplete="off">
            <div class="grid grid-cols-12 mt-8">
                <div class="col-span-12 sm:col-span-4 text-center font-semibold">
                    Examination : {{ $name }}
                </div>
                <div class="col-span-12 sm:col-span-4 text-center font-semibold">
                    Class : {{ $classmaster_name }}
                </div>
                <div class="col-span-12 sm:col-span-4 text-center font-semibold">
                    Section : {{ $section_name }}
                </div>
            </div>
            <div class="flex flex-col mt-8 intro-y">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="table table-report -mt-2">
                                <thead class="bg-primary">
                                    <tr class="intro-x">
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Subject Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Marks
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Start Time
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            End Time
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjectlist as $eachsubject)
                                        <tr class="intro-x">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ isset($eachsubject['subject_name']) ? $eachsubject['subject_name'] : '' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ isset($eachsubject['mark']) ? $eachsubject['mark'] : '' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ isset($eachsubject['date']) ? $eachsubject['date'] : '' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ isset($eachsubject['start_time']) ? $eachsubject['start_time'] : '' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ isset($eachsubject['end_time']) ? $eachsubject['end_time'] : '' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-x col-span-12 flex items-center justify-center sm:justify-end mt-5 mb-5">
                    <button type="button" wire:click="back(3)" class="btn btn-secondary w-24">Previous</button>
                    <button type="submit" class="btn btn-primary w-24 ml-2">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
