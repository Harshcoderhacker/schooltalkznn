<div class="p-4 overflow-y-auto h-5/6">
    <form wire:submit.prevent="lessontopicstore">
        <div>
            <input wire:model="name" type="text" class="form-control" placeholder="Enter the Topic Name">
            @error('name')
                <span class="font-semibold text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <select wire:model="lesson_id" class="form-select mt-2">
                <option selected>Select Lesson</option>
                @foreach ($lessonlist as $eachlessonlist)
                    <option value={{ $eachlessonlist->id }}>{{ $eachlessonlist->name }}</option>
                @endforeach
            </select>
            @error('lesson_id')
                <span class="font-semibold text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3 w-32">Add Topic</button>
    </form>
    @foreach ($lesson as $eachlesson)
        <h2 class="font-medium text-base text-primary mt-8">{{ $eachlesson->name }}</h2>
        @foreach ($eachlesson->lessontopic as $eachlessontopiclist)
            <div class="flex flex-row mt-3 p-2 border">
                <div class="w-96">
                    {{ $eachlessontopiclist->name }}
                </div>
                <div class="flex gap-2">
                    @include('helper.datatable.edit', [
                        'modalname' => 'New Topic',
                        'method' => 'editlessontopic',
                        'id' => $eachlessontopiclist->id,
                    ])
                    @include('helper.datatable.delete', [
                        'modalname' => 'New Topic',
                        'method' => 'deleteconfirm',
                        'id' => $eachlessontopiclist->uuid,
                    ])
                </div>
            </div>
        @endforeach
    @endforeach
    {{-- <div class="flex flex-row mt-3 p-2 border">
        <div class="w-96">
            Topic 1
        </div>
        <div class="flex gap-2">
            @include('helper.datatable.edit', [
                'modalname' => 'New Topic',
                'method' => 'edit',
                'id' => 1,
            ])
            @include('helper.datatable.delete', [
                'modalname' => 'New Topic',
                'method' => 'delete',
                'id' => 1,
            ])
        </div>
    </div>
    <div class="flex flex-row mt-3 p-2 border">
        <div class="w-96">
            Topic 2
        </div>
        <div class="flex gap-2">
            @include('helper.datatable.edit', [
                'modalname' => 'New Topic',
                'method' => 'edit',
                'id' => 2,
            ])
            @include('helper.datatable.delete', [
                'modalname' => 'New Topic',
                'method' => 'delete',
                'id' => 2,
            ])
        </div>
    </div>
    <div class="flex flex-row mt-3 p-2 border">
        <div class="w-96">
            Topic 3
        </div>
        <div class="flex gap-2">
            @include('helper.datatable.edit', [
                'modalname' => 'New Topic',
                'method' => 'edit',
                'id' => 3,
            ])
            @include('helper.datatable.delete', [
                'modalname' => 'New Topic',
                'method' => 'delete',
                'id' => 3,
            ])
        </div>
    </div>
    <h2 class="font-medium text-base text-primary mt-8">Lesson 2</h2>
    <div class="flex flex-row mt-3 p-2 border">
        <div class="w-96">
            Topic 1
        </div>
        <div class="flex gap-2">
            @include('helper.datatable.edit', [
                'modalname' => 'New Topic',
                'method' => 'edit',
                'id' => 1,
            ])
            @include('helper.datatable.delete', [
                'modalname' => 'New Topic',
                'method' => 'delete',
                'id' => 1,
            ])
        </div>
    </div>
    <div class="flex flex-row mt-3 p-2 border">
        <div class="w-96">
            Topic 2
        </div>
        <div class="flex gap-2">
            @include('helper.datatable.edit', [
                'modalname' => 'New Topic',
                'method' => 'edit',
                'id' => 2,
            ])
            @include('helper.datatable.delete', [
                'modalname' => 'New Topic',
                'method' => 'delete',
                'id' => 2,
            ])
        </div>
    </div>
    <div class="flex flex-row mt-3 p-2 border">
        <div class="w-96">
            Topic 3
        </div>
        <div class="flex gap-2">
            @include('helper.datatable.edit', [
                'modalname' => 'New Topic',
                'method' => 'edit',
                'id' => 3,
            ])
            @include('helper.datatable.delete', [
                'modalname' => 'New Topic',
                'method' => 'delete',
                'id' => 3,
            ])
        </div>
    </div> --}}
</div>
