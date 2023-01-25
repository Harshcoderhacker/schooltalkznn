<h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Parent Sign In</h2>
<div class="intro-x mt-2 text-gray-500 xl:hidden text-center">Get more things done with
    Edfish platform.
    The Complete Ecosystem of Education</div>
<div class="intro-x mt-8">
    <form id="parentlogin-form" autocomplete="off">
        <input id="parent-phone" type="text" class="intro-x parentlogin__input form-control py-3 px-4 border-gray-300 block" placeholder="Phone" wire:model.lazy="aparentphone">
        @error('aparentphone')
        <span class="text-red-600 mt-2 font-semibold">{{ $message }}</span>
        @enderror

        <br>
        <h6 style="text-align: center">OR</h6>

        <input id="email" type="email" class="intro-x adminlogin__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="email" wire:model.lazy="parentemail">
        @error('parentemail')
        <span class="text-red-600 mt-2 font-semibold">{{ $message }}</span>
        @enderror
    </form>
</div>
<div class="intro-x mt-5 xl:mt-8 text-center xl:text-center">
    <button wire:click="parentlogin" class="btn color text-white py-3 px-4 w-full xl:w-32 xl:mr-3 align-top text-center" wire:loading.attr="disabled">
        <div wire:loading>
            @include('helper.loadingicon.loadingicon')
        </div>
        <span wire:loading.remove>Login</span>
    </button>
</div>