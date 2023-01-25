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
            <h3>Posts</h3>
        </th>
        <th>
            <h3>Achievements</h3>
        </th>
        <th>
            <h3>Polls</h3>
        </th>
        <th>
            <h3>Stars</h3>
        </th>
    </tr>
    <tr>
        <td style="text-align:center; padding:4px; ">
            {{$topleaderboard->sum('post_count')}}
        </td>
        <td style="text-align:center; padding:4px;">
            {{$topleaderboard->sum('achievement_count')}}
        </td>
        <td style="text-align:center; padding:4px;">
            {{$topleaderboard->sum('poll_count')}}
        </td>
        <td style="text-align:center; padding:4px;">
            {{$starcount?->sum('starcount')}}
        </td>
    </tr>
</table>
<table style="margin-top:16px; width: 100%;">
    <tr>
        <td style="text-align: left;">
            <h3>
                Top Student Leaderboard
            </h3>
        </td>
        <td style="text-align: right;">
            <h3>
                @if($month!=13)
                    Month of {{$month_string}}
                    @else
                    Year {{$academicyear}}
                    @endif
            </h3>
        </td>
    </tr>
</table>
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
            <th>
                Class
            </th>
            <th style="text-align: center;
                             border:1px solid black">
                Posts
            </th>
            <th style="text-align: center;
                             border:1px solid black">
                Achievements
            </th>
            <th style="text-align: center;
                             border:1px solid black">
                Polls
            </th>
            <th style="text-align: center;
                             border:1px solid black">
                Stars
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($topleaderboard as $eachstudent)
            <tr class="intro-x">
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{$eachstudent->name}}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    {{$eachstudent->classmaster->name}}
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{$eachstudent->post_count}}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{$eachstudent->achievement_count}}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{$eachstudent->poll_count}}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{ $eachstudent->gamificationable()->sum('star') }} stars
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
