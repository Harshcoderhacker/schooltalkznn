@extends('../layout/admin/' . $layout)

@section('subhead')
<title>Edfish - Students</title>
@endsection

@section('breadcrumb')
<i data-feather="chevron-right" class="breadcrumb__icon"></i>
<a href="{{ route('adminstudent') }}" class="">Student</a>
<i data-feather="chevron-right" class="breadcrumb__icon"></i>
<p class="breadcrumb--active">Pending Complaints</p>
@endsection


@section('subcontent')
<div class=" col-span-12 xl:col-span-12 ">
    <div class="p-2">
        <div class="grid grid-cols-12 gap-3 ">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                <h2 class="text-lg font-bold text-theme-1 mr-5">Complaints</h2>
            </div>
        </div>
    </div>
</div>
<div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
    @include('admin.student.complaints.helper.studentcomplaintsmenu', ['active' => 'pending'])
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
                                Complaint By
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Complaint On
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Class & Sec
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Complaint
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-semibold text-white uppercase tracking-wider text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="intro-x">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Mrs. Meena
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Ram
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    I - A
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    24 September 2021
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Mischeavous
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <button class="btn btn-primary">View & Take Action</button>
                            </td>
                        </tr>
                        <tr class="intro-x">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Mrs. Meena
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Ram
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    I - A
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    24 September 2021
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Mischeavous
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <button class="btn btn-primary">View & Take Action</button>
                            </td>
                        </tr>
                        <tr class="intro-x">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Mrs. Meena
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Ram
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    I - A
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    24 September 2021
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Mischeavous
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <button class="btn btn-primary">View & Take Action</button>
                            </td>
                        </tr>
                        <tr class="intro-x">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Mrs. Meena
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Ram
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    I - A
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    24 September 2021
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Mischeavous
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <button class="btn btn-primary">View & Take Action</button>
                            </td>
                        </tr>
                        <tr class="intro-x">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Mrs. Meena
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Ram
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    I - A
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    24 September 2021
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Mischeavous
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <button class="btn btn-primary">View & Take Action</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#adminstudent').addClass("side-menu--active");
</script>
@endsection