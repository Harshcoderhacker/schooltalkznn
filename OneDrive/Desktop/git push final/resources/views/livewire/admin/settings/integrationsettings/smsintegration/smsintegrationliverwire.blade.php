<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include('admin.settings.integrationsettings.helper.integrationsettingsmenu', ['active' => 'sms'])
    </div>
    <div class="intro-y chat grid grid-cols-12 gap-5">
        <div class=" col-span-12">
            <div class="p-2">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">SMS Integration List</h2>
                <div class="grid grid-cols-12 gap-1 ">

                    <!-- BEGIN: Data List -->
                    @if ($smsintegration->isNotEmpty())
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">
                                            S.NO
                                        </th>
                                        <th class="whitespace-nowrap">
                                            PROVIDER NAME
                                        </th>
                                        <th class="whitespace-nowrap">SENDER ID</th>
                                        <th class="whitespace-nowrap">COUNTRY CODE</th>
                                        <th class="whitespace-nowrap">PHONE NO</th>
                                        <th class="text-center whitespace-nowrap">DEFAULT</th>
                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($smsintegration as $index => $value)
                                        <tr class="intro-x">
                                            <td class="">{{ $index + 1 }}
                                            </td>
                                            <td>
                                                <span class="font-medium whitespace-nowrap">
                                                    {{ $value->provider_name }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-medium whitespace-nowrap">
                                                    {{ $value->sender_id }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-medium whitespace-nowrap">
                                                    {{ $value->country_code }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-medium whitespace-nowrap">
                                                    {{ $value->phone_no }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <button wire:click="changedefault('{{ $value->id }}')"
                                                    class="btn {{ $value->is_default ? 'btn-secondary' : 'btn-primary' }}"
                                                    {{ $value->is_default ? 'disabled' : '' }}>{{ $value->is_default ? 'Default' : 'Make Default' }}</button>
                                            </td>
                                            <td class="table-report__action w-56">
                                                <div class="flex justify-center gap-2 items-center">

                                                    @include('helper.datatable.show',
                                                    ['modalname' => 'smsintegration-show',
                                                    'method' => 'show',
                                                    'id' => $value->id])

                                                    @include('helper.datatable.edit',
                                                    ['method' => 'edit',
                                                    'id' => $value->id])

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        @include('helper.datatable.norecordfound')
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    @if ($isModalFormOpen)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="right-0 left-0 z-50 justify-center items-center h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-3/5 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        Update SMS Intgeration
                    </h3>
                    <button wire:click="smsintegrationcloseFormModal"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="updatesmsintegration">
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium">Provider Name</label>
                                <input autocomplete="off" wire:model.lazy="provider_name" name="provider_name"
                                    id="provider_name_id" type="text" class="form-control"
                                    placeholder="Provider Name">
                                @error('provider_name') <span
                                        class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium">Sid</label>
                                <input autocomplete="off" wire:model.lazy="sid" name="sid" id="sid_id" type="text"
                                    class="form-control" placeholder="Sid">
                                @error('sid') <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium">Sender Id</label>
                                <input autocomplete="off" wire:model.lazy="sender_id" name="sender_id" id="sender_id_id"
                                    type="text" class="form-control" placeholder="Sender Id">
                                @error('sender_id') <span
                                        class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium">Token Id</label>
                                <input autocomplete="off" wire:model.lazy="token" name="token" id="token_id" type="text"
                                    class="form-control" placeholder="Token Id">
                                @error('token') <span
                                        class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium">URL ID</label>
                                <input autocomplete="off" wire:model.lazy="url" name="url" id="url_id" type="text"
                                    class="form-control" placeholder="URL ID">
                                @error('url') <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium">Country Code</label>
                                <input autocomplete="off" wire:model.lazy="country_code" name="country_code"
                                    id="country_code_id" type="text" class="form-control" placeholder="+91">
                                @error('country_code') <span
                                        class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium">Phone No</label>
                                <input autocomplete="off" wire:model.lazy="phone_no" name="phone_no" id="phone_no_id"
                                    type="text" class="form-control" placeholder="Phone No">
                                @error('phone_no') <span
                                        class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-row-reverse items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button type="button" wire:click="smsintegrationcloseFormModal"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @include('livewire.admin.settings.integrationsettings.smsintegration.smsintegrationshow')
</div>
