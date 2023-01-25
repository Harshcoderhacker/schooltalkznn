<div>
    <div id="documents" class="tab-pane" role="tabpanel" aria-labelledby="documents-tab">
        <div class="box grid grid-cols-12 intro-y mt-8 gap-4 w-full sm:w-11/12 mx-auto">
            <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
                <tbody class="divide-y-2">
                    <tr class="intro-x">
                        <th class="uppercase {{ $staff->staffotherdetail?->resume ? 'text-green-500' : '' }}">
                            Resume</th>
                        <td>
                            <form method="POST" action="{{ route('staffdetailsdownload') }}">
                                @csrf
                                <input name="downloadpath" type="hidden"
                                    value="{{ $staff->staffotherdetail?->resume }}">
                                <button type="submit" {{ $staff->staffotherdetail?->resume ? '' : 'disabled' }}>
                                    <img class="object-contain h-8 w-full" alt="download"
                                        src="{{ asset('/image/settingsicon/downloadicon/file.png') }}">
                                </button>
                            </form>
                    </tr>
                    <tr class="intro-x">
                        <th
                            class="uppercase {{ $staff->staffotherdetail?->degree_certificate ? 'text-green-500' : '' }}">
                            Degree Certificate</th>
                        <td>
                            <form method="POST" action="{{ route('staffdetailsdownload') }}">
                                @csrf
                                <input name="downloadpath" type="hidden"
                                    value="{{ $staff->staffotherdetail?->degree_certificate }}">
                                <button type="submit" {{ $staff->staffotherdetail?->degree_certificate ? '' :
                                    'disabled' }}>
                                    <img class="object-contain h-8 w-full" alt="download"
                                        src="{{ asset('/image/settingsicon/downloadicon/file.png') }}">
                                </button>
                            </form>
                        </td>
                    </tr>
    
                    <tr class="intro-x">
                        <th class="uppercase {{ $staff->staffotherdetail?->document_one ? 'text-green-500' : '' }}">
                            Document 2</th>
                        <td class="">
                            <form method="POST" action="{{ route('staffdetailsdownload') }}">
                                @csrf
                                <input name="downloadpath" type="hidden"
                                    value="{{ $staff->staffotherdetail?->document_one }}">
                                <button type="submit" {{ $staff->staffotherdetail?->document_one ? '' : 'disabled'
                                    }}>
                                    <img class="object-contain h-8 w-full" alt="download"
                                        src="{{ asset('/image/settingsicon/downloadicon/file.png') }}">
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr class="intro-x" class="sm:hidden">
                        <th> </th>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
                <tbody class="divide-y-2">
                    <tr class="intro-x">
                        <th
                            class="uppercase {{ $staff->staffotherdetail?->school_certificate ? 'text-green-500' : '' }}">
                            School certificate</th>
                        <td>
                            <form method="POST" action="{{ route('staffdetailsdownload') }}">
                                @csrf
                                <input name="downloadpath" type="hidden"
                                    value="{{ $staff->staffotherdetail?->school_certificate }}">
                                <button type="submit" {{ $staff->staffotherdetail?->school_certificate ? '' :
                                    'disabled' }}>
                                    <img class="object-contain h-8 w-full" alt="download"
                                        src="{{ asset('/image/settingsicon/downloadicon/file.png') }}">
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <th
                            class="uppercase {{ $staff->staffotherdetail?->degree_certificate ? 'text-green-500' : '' }}">
                            Document 1</th>
                        <td>
                            <form method="POST" action="{{ route('staffdetailsdownload') }}">
                                @csrf
                                <input name="downloadpath" type="hidden"
                                    value="{{ $staff->staffotherdetail?->degree_certificate }}">
                                <button type="submit" {{ $staff->staffotherdetail?->degree_certificate ? '' :
                                    'disabled' }}>
                                    <img class="object-contain h-8 w-full" alt="download"
                                        src="{{ asset('/image/settingsicon/downloadicon/file.png') }}">
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <th
                            class="uppercase {{ $staff->staffotherdetail?->document_three ? 'text-green-500' : '' }}">
                            Document 3</th>
                        <td>
                            <form method="POST" action="{{ route('staffdetailsdownload') }}">
                                @csrf
                                <input name="downloadpath" type="hidden"
                                    value="{{ $staff->staffotherdetail?->document_three }}">
                                <button type="submit" {{ $staff->staffotherdetail?->document_three ? '' : 'disabled'
                                    }}>
                                    <img class="object-contain h-8 w-full" alt="download"
                                        src="{{ asset('/image/settingsicon/downloadicon/file.png') }}">
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr class="intro-x" class="sm:hidden">
                        <th class="uppercase"></th>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
