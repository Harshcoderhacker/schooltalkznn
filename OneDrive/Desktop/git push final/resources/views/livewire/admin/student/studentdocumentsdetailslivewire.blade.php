<div>
    <div class="box p-2 mt-5">
        <div class="flex">
            <table class="col-span-12 sm:col-span-6 w-full sm:w-6/12 table mt-3 rounded-lg">
                <tbody class="divide-y-2">
                    <tr class="intro-x">
                        <th class="uppercase">Aadhar Number</th>
                        <td>{{ $student->adhaar_no }}</td>
                    </tr>
                    <tr class="intro-x">
                        <th class="uppercase {{ $student->photo ? 'text-green-500' : '' }}">
                            Photo</th>
                        <td>
                            @if($student->photo)
                            <form method="POST" action="{{ route('studentdetailsdownload') }}">
                                @csrf
                                <input name="downloadpath" type="hidden" value="{{ $student->photo }}">
                                <button type="submit">
                                    <img class="object-contain h-8 w-full" alt="download"
                                        src="{{ asset('/image/settingsicon/downloadicon/file.png') }}">
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
