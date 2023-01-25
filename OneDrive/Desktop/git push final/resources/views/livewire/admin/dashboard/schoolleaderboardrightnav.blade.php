@if ($schoolleaderboardrightnav)
    <div class="right-0 left-0 justify-end h-screen inset-0 fixed bg-smoke-dark flex animate__animated animate__fadeInLeftBig"
        style="z-index:52;">
        <div type="button" wire:click="closeschoolleaderboardmodal" class="absolute inset-0 bg-gray-500 opacity-75">
        </div>
        <div class="relative md:w-2/5 w-full">
            <div class="relative bg-white rounded h-screen shadow dark:bg-gray-700">
                <div class="flex justify-between items-center bg-primary p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-lg font-medium text-white">
                        School Leaderboard
                    </h3>
                    <button type="button" wire:click="closeschoolleaderboardmodal"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto h-5/6">
                    <table class="table-auto w-full">
                        <tbody class="font-bold">
                            @foreach ($schoolleaderboardallstudent as $eachschoolleaderboardallstudent)
                                <tr>
                                    <td>
                                        <div class="w-8 h-8 my-3 rounded-full overflow-hidden shadow-lg image-fit">
                                            @if ($eachschoolleaderboardallstudent->avatar)
                                                <img alt="{{ $eachschoolleaderboardallstudent->name }} image"
                                                    class="rounded-full"
                                                    src="{{ url('storage/' . $eachschoolleaderboardallstudent->avatar) }}">
                                            @else
                                                <img alt="{{ $eachschoolleaderboardallstudent->name }} image"
                                                    class="rounded-full"
                                                    src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div> {{ $eachschoolleaderboardallstudent->name }}</div>
                                        <div class="text-gray-600 font-normal">
                                            {{ $eachschoolleaderboardallstudent->classmaster->name }}</div>
                                    </td>
                                    <td class="text-primary">{{ $eachschoolleaderboardallstudent->post_count }} posts
                                    </td>
                                    <td class="text-warning">{{ $eachschoolleaderboardallstudent->poll_count }} polls
                                    </td>
                                    <td class="text-success">
                                        {{ $eachschoolleaderboardallstudent->gamificationable()->sum('star') }} stars
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
