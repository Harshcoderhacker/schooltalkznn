<div wire:ignore>
    <select class="hastagdropdown" multiple="multiple">
        @foreach ($allfeedtag as $eachtag)
            <option>{{ $eachtag->name }}</option>
        @endforeach
    </select>
</div>
