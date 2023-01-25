<h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left"> {{isset($panel['type']) ? $panel['type'] : 'Admin'}}  Sign
    In</h2>
<div class="intro-x mt-2 text-gray-500 xl:hidden text-center">Get more things done with
    Edfish platform.
    The Complete Ecosystem of Education</div>
<div class="intro-x mt-8">
    <form id="otp-form" autocomplete="off">
        <input class="otp" type="text" wire:model="otp.0" style="display:inline-block;width:50px;height:50px;text-align:center;" oninput='digitValidate(this)' onkeyup='tabChange(1)' maxlength=1 >
        <input class="otp" type="text" wire:model="otp.1"  style="display:inline-block;width:50px;height:50px;text-align:center;" oninput='digitValidate(this)' onkeyup='tabChange(2)' maxlength=1 >
        <input class="otp" type="text"wire:model="otp.2"  style="display:inline-block;width:50px;height:50px;text-align:center;" oninput='digitValidate(this)' onkeyup='tabChange(3)' maxlength=1 >
        <input class="otp" type="text"  wire:model="otp.3" style="display:inline-block;width:50px;height:50px;text-align:center;" oninput='digitValidate(this)'onkeyup='tabChange(4)' maxlength=1 >
        <input class="otp" type="text" wire:model="otp.4" style="display:inline-block;width:50px;height:50px;text-align:center;" oninput='digitValidate(this)'onkeyup='tabChange(5)' maxlength=1 >
        <input class="otp" type="text" wire:model="otp.5" style="display:inline-block;width:50px;height:50px;text-align:center;" oninput='digitValidate(this)'onkeyup='tabChange(6)' maxlength=1 >
{{--        <input id="otp" type="text" class="intro-x adminlogin__input form-control py-3 px-4 border-gray-300 block"--}}
{{--               placeholder="otp" wire:model.lazy="otp">--}}
    </form>
    @error('otp')
    <span class="text-red-600 mt-2 font-semibold">{{ $message }}</span>
    @enderror

</div>
<div class="intro-x mt-5 xl:mt-8 text-center xl:text-center">

    <div class="intro-x flex text-white-700 dark:text-white-600 text-xs sm:text-sm mt-4">
        <a href="javascript:void(0)"  wire:click.prevent="email('{{isset($panel['email']) ? $panel['email'] : ''}}', '{{isset($panel['panel']) ? $panel['panel'] : ''}}',true)">Resend OTP</a>
    </div>

    <button class="btn color text-white` py-3 px-4 w-full xl:w-35 xl:mr-3 align-top text-center" wire:click="email('{{isset($panel['email']) ? $panel['email'] : ''}}', '{{isset($panel['panel']) ? $panel['panel'] : ''}}',false)"
            wire:loading.attr="disabled" style="font-weight:600;margin-top:20px;font-size:24px">
        <div wire:loading>
            @include('helper.loadingicon.loadingicon')
        </div>
        <span wire:loading.remove>Verify OTP</span>
    </button>
</div>

<script>
    let digitValidate = function(ele){
        // alert(ele.value);
        ele.value = ele.value.replace(/[^0-9]/g,'');
    }

    let tabChange = function(val){
        let ele = document.querySelectorAll('input');
        console.log(ele);
        if(ele[val-1].value != ''){
            ele[val].focus()
        }else if(ele[val-1].value == ''){
            ele[val-2].focus()
        }
    }
</script>
