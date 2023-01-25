<div>
    <div class="intro-y chat grid grid-cols-12 gap-5">
        <div class=" col-span-12">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1 mt-5">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                        <h2 class="intro-y text-xl font-medium mt-3">Label List</h2>
                        <div class="hidden md:block mx-auto text-slate-500"></div>
                    </div>

                    <!-- BEGIN: Data List -->
                    @if ($hasttag)
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
                        <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">
                                        S.NO
                                    </th>
                                    <th class="text-center whitespace-nowrap">
                                        <div class="flex">
                                            HASHTAG
                                        </div>
                                    </th>
                                    <th class="whitespace-nowrap">COUNT</th>
                                    {{-- <th class="text-center whitespace-nowrap">ACTIONS</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasttag as $index => $value)
                                <tr class="intro-x">
                                    <td class="">{{ $index + 1 }}</td>
                                    <td>
                                        <span class="font-medium whitespace-nowrap">
                                            {{ $value['name'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="font-medium whitespace-nowrap">
                                            {{ $value['feedpost_count'] }}
                                        </span>
                                    </td>
                                    {{-- <td class="table-report__action w-56">
                                        <div class="flex justify-center gap-2 items-center">


                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>


                                        </div>
                                    </td> --}}
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
</div>