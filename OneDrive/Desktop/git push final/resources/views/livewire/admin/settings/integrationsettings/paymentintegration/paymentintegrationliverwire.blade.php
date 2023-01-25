<div>
    <div class="chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include('admin.settings.integrationsettings.helper.integrationsettingsmenu', ['active' => 'payment'])
    </div>
    <div class="chat grid grid-cols-12 gap-5 ">
        @if ($paymentintegrationid)
            <div class="col-start-2 col-span-12 xl:col-span-4 mt-4">
                <div class="block sm:flex items-center h-10">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">{{ $gateway_name }} Integration
                    </h2>
                </div>
                <div class="box p-5 mt-12 sm:mt-5 mx-5">
                    <form wire:submit.prevent="createorupdate">
                        <div class="relative text-gray-700 dark:text-gray-300">
                            <div>
                                <label for="gateway_username" class="form-label font-medium">Gateway Username</label>
                                <input wire:model="gateway_username" id="gateway_username" type="text"
                                    class="form-control" placeholder="Name" id="gateway_username" autocomplete="off">
                                @error('gateway_username') <span class="text-theme-6 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="gateway_secret_key" class="form-label font-medium mt-3">Gateway Secret
                                    Key</label>
                                <textarea rows="4" wire:model="gateway_secret_key" id="gateway_secret_key" type="text"
                                    class="form-control" placeholder="Name" id="gateway_secret_key"></textarea>
                                @error('gateway_secret_key') <span class="text-theme-6 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="gateway_publisher_key" class="form-label font-medium mt-3">Gateway
                                    Publisher Key </label>
                                <textarea rows="4" wire:model="gateway_publisher_key" id="gateway_publisher_key"
                                    type="text" class="form-control" placeholder="Name"
                                    id="gateway_publisher_key"></textarea>
                                @error('gateway_publisher_key') <span
                                        class="text-theme-6 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-3 gap-2 justify-center">
                            <button type="submit" class="btn btn-primary">Update {{ $gateway_name }}</button>
                            <a wire:click="formcancel" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <div class="col-span-12 {{ $paymentintegrationid ? 'xl:col-span-8' : '' }}">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1 ">

                    @include('helper.datatable.header',
                    ['title' => 'Payment Integration List',
                    'search' => 'searchTerm'])

                    <!-- BEGIN: Data List -->
                    @if ($paymentintegration->isNotEmpty())
                        <div class="col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">
                                            S.NO
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            <div class="flex">
                                                GATEWAY NAME

                                                @include('helper.datatable.sorting',
                                                ['method' => 'sortBy',
                                                'value' => 'gateway_name'])

                                            </div>
                                        </th>
                                        <th class="whitespace-nowrap">GATEWAY USERNAME</th>
                                        <th class="text-center whitespace-nowrap">DEFAULT</th>
                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentintegration as $index => $value)
                                        <tr>
                                            <td class="">{{ $paymentintegration->firstItem() + $index }}
                                            </td>
                                            <td>
                                                <span
                                                    class="font-medium whitespace-nowrap">{{ $value->gateway_name }}</span>
                                            </td>
                                            <td>
                                                <span class="font-medium whitespace-nowrap">
                                                    {{ $value->gateway_username }}
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
                                                    ['modalname' => 'paymentintegration-show',
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
                        @include('helper.datatable.pagination', ['pagination' => $paymentintegration])
                    @else
                        @include('helper.datatable.norecordfound')
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('livewire.admin.settings.integrationsettings.paymentintegration.paymentintegrationshow')
</div>
