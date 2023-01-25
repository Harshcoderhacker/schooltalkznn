<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include('admin.settings.onlineassessment.helper.onlineassessmentmenu', ['active' => 'mapboard'])
    </div>
    <div class="intro-y chat grid grid-cols-12 gap-5 ">
        <div class="col-start-2 col-span-12 xl:col-span-4 mt-4">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Map Board</h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5 mx-5">
                <form wire:submit.prevent="createorupdate">
                    <div class="relative text-gray-700 dark:text-gray-300">
                        <select class="form-select" wire:model="mapboard_uuid">
                            <option>Select the Board</option>
                            @foreach($mapboardlist as $key => $value)
                            <option value={{$key}}>
                                {{$value}}
                            </option>
                            @endforeach
                        </select>
                        @error('mapboard_uuid') <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                        <button type="submit" {{ $mapboardsubmitbtn ? 'disabled' : '' }}
                            class="btn btn-primary w-full mt-3">Map Board</button>
                </form>
            </div>
        </div>
        <div class=" col-span-12 xl:col-span-8 ">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1 ">
                    <!-- BEGIN: Data List -->
                    @if ($mapboard)
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">
                                            Board
                                        </th>
                                        <th class="whitespace-nowrap">
                                            Mapped By
                                        </th>
                                        <th class="whitespace-nowrap">
                                            Mapped At
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr class="intro-x">
                                            <td>
                                                <span class="font-medium whitespace-nowrap">{{$board[$mapboard->mapboard_uuid]}}</span>
                                            </td>
                                            <td>
                                                <span class="font-medium whitespace-nowrap">{{$mapboard->created_by}}</span>
                                            </td>
                                            <td>
                                                <span class="font-medium whitespace-nowrap">{{$mapboard->created_at->format('d-M-Y h:i:s')}}</span>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                        <div class="mx-auto flex flex-row items-center">
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                                <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Board</span></p>
                                <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to map board</p>
                            </div>
                            <div>
                                <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character1.png') }}"
                                        alt="ppl">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
</div>
