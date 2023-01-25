<div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap mt-2 gap-4">
    <div class="w-full">
        {{ $pagination->links('vendor.livewire.tailwind') }}
    </div>
    <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto">
        <select wire:click="updatepagination" wire:model="paginationlength"
            class="w-20 form-select box mt-3 sm:mt-0 hidden md:block text-gray-600 dark:text-white mx-0">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
    </div>
</div>
