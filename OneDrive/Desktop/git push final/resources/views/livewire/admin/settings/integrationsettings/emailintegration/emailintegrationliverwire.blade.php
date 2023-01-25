<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include('admin.settings.integrationsettings.helper.integrationsettingsmenu', ['active' => 'email'])
    </div>
    <div class="intro-y chat grid grid-cols-12 gap-5">
        <div class=" col-span-12">
            <div class="p-2">

                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">E-Mail Integration List</h2>

                @if ($emailintegration->isNotEmpty())
                    <div class="grid grid-cols-12 gap-1 ">
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
                                        <th class="whitespace-nowrap">EMAIL FROM NAME</th>
                                        <th class="whitespace-nowrap">EMAIL FROM MAIL</th>
                                        <th class="whitespace-nowrap">EMAIL MAIL USERNAME</th>
                                        <th class="text-center whitespace-nowrap">DEFAULT</th>
                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emailintegration as $index => $value)
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
                                                    {{ $value->email_from_name }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-medium whitespace-nowrap">
                                                    {{ $value->email_from_mail }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-medium whitespace-nowrap">
                                                    {{ $value->email_mail_username }}
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
                                                    ['modalname' => 'emailintegration-show',
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
                    Update E-Mail Intgeration
                </h3>
                <button wire:click="emailintegrationcloseFormModal"
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
            <form wire:submit.prevent="updateemailintegration">
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12 sm:col-span-6">
                            <label for="provider_name_id" class="form-label font-medium">Provider Name</label>
                            <input autocomplete="off" wire:model.lazy="provider_name" name="provider_name"
                                id="provider_name_id" type="text" class="form-control" placeholder="Provider Name">
                            @error('provider_name') <span
                                    class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="email_from_name_id" class="form-label font-medium">E-mail From Name</label>
                            <input autocomplete="off" wire:model.lazy="email_from_name" name="email_from_name"
                                id="email_from_name_id" type="text" class="form-control"
                                placeholder="E-mail From Name">
                            @error('email_from_name') <span
                                    class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="email_from_mail_id" class="form-label font-medium">E-mail From Mail</label>
                            <input autocomplete="off" wire:model.lazy="email_from_mail" name="email_from_mail"
                                id="email_from_mail_id" type="text" class="form-control"
                                placeholder="E-mail From Mail">
                            @error('email_from_mail') <span
                                    class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="email_mail_driver_id" class="form-label font-medium">E-mail Mail
                                Driver</label>
                            <input autocomplete="off" wire:model.lazy="email_mail_driver" name="email_mail_driver"
                                id="email_mail_driver_id" type="text" class="form-control"
                                placeholder="E-mail Mail Driver">
                            @error('email_mail_driver') <span
                                    class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="email_mail_host_id" class="form-label font-medium">E-mail Mail Host</label>
                            <input autocomplete="off" wire:model.lazy="email_mail_host" name="email_mail_host"
                                id="email_mail_host_id" type="text" class="form-control"
                                placeholder="E-mail Mail Host">
                            @error('email_mail_host') <span
                                    class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="email_mail_port_id" class="form-label font-medium">E-mail Mail Port</label>
                            <input autocomplete="off" wire:model.lazy="email_mail_port" name="email_mail_port"
                                id="email_mail_port_id" type="text" class="form-control"
                                placeholder="E-mail Mail Port">
                            @error('email_mail_port') <span
                                    class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="email_mail_username_id" class="form-label font-medium">E-mail Mail
                                Username</label>
                            <input autocomplete="off" wire:model.lazy="email_mail_username" name="email_mail_username"
                                id="email_mail_username_id" type="text" class="form-control"
                                placeholder="E-mail Mail Username">
                            @error('email_mail_username') <span
                                    class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="email_mail_password_id" class="form-label font-medium">E-mail Mail
                                Password</label>
                            <input autocomplete="off" wire:model.lazy="email_mail_password" name="email_mail_password"
                                id="email_mail_password_id" type="text" class="form-control"
                                placeholder="E-mail Mail Password">
                            @error('email_mail_password') <span
                                    class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="email_mail_encryption_id" class="form-label font-medium">E-mail Mail
                                Encryption</label>
                            <input autocomplete="off" wire:model.lazy="email_mail_encryption"
                                name="email_mail_encryption" id="email_mail_encryption_id" type="text"
                                class="form-control" placeholder="E-mail Mail Encryption">
                            @error('email_mail_encryption') <span
                                    class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-row-reverse items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <button type="button" wire:click="emailintegrationcloseFormModal"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endif
@include('livewire.admin.settings.integrationsettings.emailintegration.emailintegrationshow')
</div>
