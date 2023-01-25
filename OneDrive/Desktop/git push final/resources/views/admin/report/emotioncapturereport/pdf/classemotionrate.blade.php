<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <table style="border-collapse: collapse;
                    border-spacing: 0;
                    margin-top:16px;
                    width: 100%;
                    border: 1px solid black">
    <tr>
        <td colspan="2" style="text-align:center">
            <h1>{{ App::make('generalsetting')->schoolname }}</h1>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center">
            <p>{{ App::make('generalsetting')->address }}</p>
        </td>
    </tr>
    <tr>
        <td style="text-align:left; padding: 15px;">
            {{ App::make('generalsetting')->phone }}
        </td>
        <td style="text-align:right; padding: 15px;">
            {{ App::make('generalsetting')->email }}
        </td>
    </tr>
</table>
<table style="border-collapse: collapse;
                    border-spacing: 0;
                    margin-top:16px;
                    width: 100%;
                    border: 1px solid black">
    <tr>
        <th>
            <h3>Students</h3>
        </th>
        <th>
            <h3>Positivity</h3>
        </th>
        <th>
            <h3>Students Needing Help</h3>
        </th>
    </tr>
    <tr>
        <td style="text-align:center; padding:4px; ">
            {{$student->count()}}
        </td>
        <td style="text-align:center; padding:4px;">
            @if($month)
                {{round(array_sum($positivity)/$student->count())}} %
            @else
                {{round((($studentsneedsattention->sum('excited')+$studentsneedsattention->sum('happy'))/$student->count())*100)}} %
            @endif
        </td>
        <td style="text-align:center; padding:4px;">
            {{$studentneedattentioncount}}
        </td>
    </tr>
</table>
<table style="border-collapse: collapse;
                    border-spacing: 0;
                    margin-top:16px;
                    width: 100%;
                    border: 1px solid black">
                    @if($month)
    <tr>
        <td style="text-align:center; padding: 15px;">Happy - H</td>
        <td style="text-align:center; padding: 15px;">Excited - E </td>
        <td style="text-align:center; padding: 15px;">Neutral - N </td>
        <td style="text-align:center; padding: 15px;">Feared - F</td>
        <td style="text-align:center; padding: 15px;">Disturbed - D</td>
        <td style="text-align:center; padding: 15px;">Not Updated - NU</td>
        <td style="text-align:center; padding: 15px;">P% - Postivity%</td>
    </tr>
    @else
    <td style="text-align:center; padding: 15px;">Happy - {{$studentsneedsattention->sum('happy')}}</td>
        <td style="text-align:center; padding: 15px;">Excited - {{$studentsneedsattention->sum('excited')}} </td>
        <td style="text-align:center; padding: 15px;">Neutral - {{$studentsneedsattention->sum('neutral')}} </td>
        <td style="text-align:center; padding: 15px;">Feared - {{$studentsneedsattention->sum('scared')}}</td>
        <td style="text-align:center; padding: 15px;">Disturbed - {{$studentsneedsattention->sum('distrubed')}}</td>
        <td style="text-align:center; padding: 15px;">N/A - {{$studentsneedsattention->sum('notupdated')}}</td>
        @endif
</table>
<table style="margin-top:16px; width: 100%;">
    <tr>
        <td style="text-align: left;">
            <h3>
                Class {{ $student[0]->classmaster->name }}
            </h3>
        </td>
        <td style="text-align: right;">
            <h3>
                {{$day}}
            </h3>
        </td>
    </tr>
</table>
@if($month)
<table style="border-collapse: collapse;
                    border-spacing: 0;
                    margin-top:16px;
                    width: 100%;
                    border: 1px solid black">
    <thead>
        <tr class="intro-x">
            <th style="text-align: center;
                             border:1px solid black">
                Student
            </th>
            <th style="text-align: center;
                             border:1px solid black">
                E
            </th>
            <th style="text-align: center;
                             border:1px solid black">
                H
            </th>
            <th style="text-align: center;
                             border:1px solid black">
                N
            </th>
            <th style="text-align: center;
                             border:1px solid black">
                F
            </th>
            <th style="text-align: center;
                             border:1px solid black">
                D
            </th>
            <th style="text-align: center;
                             border:1px solid black">
                NU
            </th>
            <th style="text-align: center;
                             border:1px solid black">
                P%
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($studentsneedsattention as $key=>$eachstudent)
            <tr class="intro-x">
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{$eachstudent->name}}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{$eachstudent->excited ? $eachstudent->excited : 0 }}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{$eachstudent->happy ? $eachstudent->happy : 0 }}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{$eachstudent->neutral ? $eachstudent->neutral : 0 }}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{$eachstudent->scared ? $eachstudent->scared : 0 }}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{$eachstudent->distrubed ? $eachstudent->distrubed : 0 }}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        @if(sizeof($notupdated)>0)
                            {{$notupdated[$key]}}
                            @else
                            0 
                        @endif
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        @if(sizeof($positivity)>0)
                        {{$positivity[$key]}} %
                        @else
                        0 %
                        @endif
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<table style="border:1px solid black; border-collapse:collapse;width:100%;">
    <thead>
        <tr>
            <th style="text-align: center;
                        border:1px solid black">
                Student
            </th>
            <th style="text-align: center;
                        border:1px solid black">
                Emotion
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($studentsneedsattention as $key=>$eachstudent)
        <tr>
        <td style="text-align: center;
        border:1px solid black">
            {{$eachstudent->name}}
        </td>
        <td style="text-align: center;
        border:1px solid black">
            @if($eachstudent->excited)
            <span>Excited</span>
            @elseif($eachstudent->happy)
            <span>Happy</span>
            @elseif($eachstudent->netural)
            <span>Normal</span>
            @elseif($eachstudent->scared)
            <span>Feared</span>
            @elseif($eachstudent->disturbed)
            <span> Disturbed </span>
            @else
                -
            @endif
        </td>
        @endforeach
    </tr>
    </tbody>
</table>
@endif
</body>
</html>
