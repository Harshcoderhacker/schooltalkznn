<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 4 ? '' : 'hidden' }}">

    @include('admin.accounts.fee.helper.createfeeformwizard', [
    'active' => 'feeconfirmation',
    ])
    <form wire:submit.prevent="submitfee" autocomplete="off">
        <div class="mt-8 w-full mx-auto sm:w-3/4 p-5">
            <div class="text-center font-semibold">
                Fee: {{ $name }}
            </div>
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-1" class="form-label font-semibold">Class:
                        {{ $classmaster_name }}</label>
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-2" class="form-label font-semibold">Sections:
                        {{ $section_name }}</label>
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-3" class="form-label font-semibold">Assigned for:
                        {{ $assigntype == 1 ? 'All Students' : 'Selected Students' }}</label>
                </div>
            </div>
            <table class="table table-report -mt-2">
                <thead class="bg-primary">
                    <tr class="intro-x">
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            particulars
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                            Amount
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($particular as $eachparticular)
                    <tr class="intro-x">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                {{ isset($eachparticular['feeparticular_name']) ? $eachparticular['feeparticular_name']
                                : '' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                {{ round($eachparticular['amount'], 2) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="intro-x">
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <span
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-white text-gray-900">
                                Total
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                {{ round($total_amount, 2) }}
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
            <div class="intro-x col-span-12 flex items-center justify-center sm:justify-end mt-5 mb-5">
                <button type="submit" class="btn btn-primary w-24 ml-2">Submit</button>
            </div>
        </div>
    </form>
</div>