<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Progress</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .brand-section {
            padding: 10px 40px 2px 40px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="brand-section">

            <div style="text-align: center; border-bottom: 1px solid rgb(173, 173, 173);">
                <h2>{{ App::make('generalsetting')->schoolname }}</h2>
                <p style="font-weight: bold">{{ App::make('generalsetting')->address }}</p>
            </div>
        </div>
        <div style="margin: 0 25px 0 25px;">
            <div style="font-size: 22px;font-weight: bold;margin: 10px 0;">
                Lesson Planner Progress : {{ $classmaster->name }} - {{ $section->name }}
            </div>
            <table style="width:100%">
                <thead style="text-align: center; font-weight:bold;">
                    <tr>
                        <td>Class / Month</td>
                        @foreach ($month as $key => $eachmonth)
                            <td class="pb-2">{{ $eachmonth }}</td>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assignsubject as $eachassignsubject)
                        <tr>
                            <td style="font-weight:bold;">{{ $eachassignsubject->subject->name }}</td>
                            @foreach ($month as $key => $eachmonth)
                                @php
                                    $lesson = App\Models\Admin\Lessonplanner\Lesson::where('classmaster_id', $classmaster->id)
                                        ->where('section_id', $section->id)
                                        ->where('subject_id', $eachassignsubject->subject->id)
                                        ->whereMonth('start_date', $key)
                                        ->get();
                                @endphp
                                <td>
                                    @foreach ($lesson as $eachlesson)
                                        @php
                                            if ($eachlesson->is_completed) {
                                                $status_color = '#4CD137';
                                            } elseif ($eachlesson->due_date < Carbon\Carbon::now()) {
                                                $status_color = '#E84118';
                                            } else {
                                                $status_color = '#E67E22';
                                            }
                                            
                                        @endphp

                                        @if ($key % 2 == 0)
                                            <div class="text-white p-1 my-1 text-center rounded"
                                                style="background-color: {{ $status_color }}; color:white; padding: 1px; margin: 2px; text-align:center; border-radius: 5px;">
                                                {{ $eachlesson->name }}
                                            </div>
                                        @else
                                            <br><br>
                                            <div class=" text-white p-1 my-1 text-center rounded"
                                                style="background-color: {{ $status_color }}; color:white; padding: 1px; margin: 2px; text-align:center; border-radius: 5px;">
                                                {{ $eachlesson->name }}
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
