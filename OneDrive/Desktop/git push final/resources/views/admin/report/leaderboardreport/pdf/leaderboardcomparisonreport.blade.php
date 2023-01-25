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
        <td style="text-align:center; padding:4px;">
            {{array_sum($postcount)}}
        </td>
        <td style="text-align:center; padding:4px; ">
            {{array_sum($achievementcount)}}
        </td>
        <td style="text-align:center; padding:4px;">
            {{array_sum($pollcount)}}
        </td>
        <td style="text-align:center; padding:4px;">
            {{array_sum($starcount)}}
        </td>
    </tr>
</table>
<table style="margin-top:16px; width: 100%;">
    <tr>
        <td style="text-align: left;">
            <h3>
                Leaderboard Class Comparision
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
        @foreach ($classmaster as $key=>$eachclassmaster)
            <tr class="intro-x">
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        Class {{$eachclassmaster->name}}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    {{$postcount[$key]}}
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{$achievementcount[$key]}}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{$pollcount[$key]}}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{$starcount[$key]}}
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
