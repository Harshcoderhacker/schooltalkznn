<div>
    <div id="progress" class="tab-pane" role="tabpanel" aria-labelledby="progress-tab">
                <div class="box p-2 mt-5">
                    <div class="intro-y col-span-12 mt-8 overflow-auto lg:overflow-visible">
                        @if($exam)
                        <table class="table -mt-2">
                            <th>
                                Subject
                            </th>
                            <th>
                                Exam Name
                            </th>
                            <th>
                                Marks Obtained
                            </th>
                            <th>
                                Subject Grade
                            </th>
                            <th>
                                Remarks
                            </th>
                            @foreach ($exam->unique('subject_id') as $eachexam)
                                @foreach ($eachexam->examsubject as $eachsubject)
                                    <tr>
                                        <td>
                                            {{ $eachsubject->subject->name }}
                                        </td>
                                        <td>
                                            <table>
                                                @foreach ($exam as $eachexam)
                                                    <tr>
                                                        <td>{{ $eachexam->name }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                @foreach ($exam as $eachexam)
                                                    <tr>
                                                        <td>
                                                            {{ $eachexam->overallmark($student->id, $eachsubject->subject_id) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                @foreach ($exam as $eachexam)
                                                    <tr>
                                                        <td>
                                                            @foreach ($grade as $eachgrade)
                                                                @if ($eachgrade->percentage_from <= $eachexam->overallmark($student->id, $eachsubject->subject_id) && $eachgrade->percentage_to > $eachexam->overallmark($student->id, $eachsubject->subject_id))
                                                                    {{ $eachgrade->name }}
                                                                @elseif($eachexam->overallmark($student->id, $eachsubject->subject_id) == 100 && $eachgrade->percentage_to == 100)
                                                                    {{ $eachgrade->name }}
                                                                @elseif($eachexam->overallmark($student->id, $eachsubject->subject_id) == '-')
                                                                    -
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                @foreach ($exam as $eachexam)
                                                    <tr>
                                                        <td>
                                                            {{ $eachexam->remark($student->id, $eachsubject->subject_id) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </table>
                        @else
                        @include('helper.datatable.norecordfound')
                        @endif
                    </div>
                </div>
            </div>
</div>
