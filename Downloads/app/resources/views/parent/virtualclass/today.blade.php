@extends('../layout/parent/' . $layout)

@section('subhead')
    <title>Edfish - Virtual Class</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'parentvirtualclasstoday',
        'name' => 'Virtual Class',
    ])
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Today'])
@endsection


@section('subcontent')
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include(
            'parent.virtualclass.helper.parentvirtualclassmenu',
            ['active' => 'today']
        )
    </div>
    <div class="grid grid-cols-12 gap-1 mt-5">
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead class="bg-primary">
                    <tr class="intro-x">
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Title
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Date
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Start Time
                            </div>
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                End Date
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Host
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Recurring
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                English
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Nov 7,2021
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                10 AM
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                10.45 AM
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Mr. Raj
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium text-center">
                                Yes
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium">
                                <button type="button" class="btn btn-danger w-24">Ended</button>
                            </span>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Tamil
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Nov 7,2021
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                10 AM
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                10.45 AM
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Mr. Raj
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium text-center">
                                Yes
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium">
                                <button type="button" class="btn btn-primary w-24">Join</button>
                            </span>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                English
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Nov 7,2021
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                10 AM
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                10.45 AM
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Mr. Raj
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium text-center">
                                Yes
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium">
                                <button type="button" class="btn btn-warning w-24">Yet to Join</button>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto">
                <select class="w-20 form-select box mt-3 sm:mt-0 hidden md:block text-gray-600 mx-0">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#parentvirtualclasstoday').addClass("side-menu--active");
    </script>
@endsection
