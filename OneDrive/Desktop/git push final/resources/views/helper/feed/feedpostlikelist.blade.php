<button class="intro-x flex mr-2" wire:click="openfeedpostlikemodal({{ $feedpost->id }})">
    <div class="intro-x w-8 h-8 image-fit">
    </div>
    @foreach ($feedpost->feedpostlike as $key => $eachpostlikelist)
        @if ($key <= 2)
            <div class="intro-x w-8 h-8 image-fit -ml-4">
                @if ($eachpostlikelist->feedpostlikeable->avatar)
                    <img alt="Rubick Tailwind HTML Admin Template"
                        class="rounded-full border border-white zoom-in tooltip"
                        src="{{ url('storage/' . $eachpostlikelist->feedpostlikeable->avatar) }}"
                        title="{{ $eachpostlikelist->feedpostlikeable->name }} - ({{ $eachpostlikelist->feedpostlikeable->usertype }})">
                @else
                    <img alt="Rubick Tailwind HTML Admin Template"
                        class="rounded-full border border-white zoom-in tooltip"
                        src="{{ asset('dist/images/placeholders/200x200.jpg') }}"
                        title="{{ $eachpostlikelist->feedpostlikeable->name }} - ({{ $eachpostlikelist->feedpostlikeable->usertype }})">
                @endif
            </div>
        @endif
    @endforeach
</button>
