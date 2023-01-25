@foreach ($user->notifications()->take($pagination ? $paginate : 15)->latest()->get()
    as $key => $eachnotification)
    <div class="cursor-pointer relative flex items-center mt-2">
        <div class="w-12 h-12 flex-none image-fit mr-1">
            @php
                switch ($eachnotification->data['usertype']) {
                    case 'ADMIN':
                        $avatar = App\Models\Admin\Auth\User::find($eachnotification->data['user_id'])->avatar;
                        break;
                    case 'STAFF':
                        $avatar = App\Models\Staff\Auth\Staff::find($eachnotification->data['user_id'])->avatar;
                        break;
                    case 'STUDENT':
                        $avatar = App\Models\Admin\Student\Student::find($eachnotification->data['user_id'])->avatar;
                        break;
                    default:
                        Illuminate\Support\Facades\Log::error('------ Invalid Type -----UsernotificationResource-----');
                }
            @endphp
            @if ($avatar)
                <img class="rounded-full" src="{{ url('storage/' . $avatar) }}">
            @else
                <img class="rounded-full" src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
            @endif
        </div>
        <div class="ml-2">
            <div>
                <p class="font-medium mr-5 break-all text-primary">
                    {{ $eachnotification->data['fullname'] }}
                    <span
                        class="font-normal dark:text-gray-50 text-gray-700">{{ $eachnotification->data['message'] }}</span>
                    <span class="text-xs text-slate-400 ml-auto whitespace-nowrap">
                        {{ $eachnotification->created_at->diffForhumans() }}</span>
                </p>
            </div>
        </div>
    </div>
@endforeach
