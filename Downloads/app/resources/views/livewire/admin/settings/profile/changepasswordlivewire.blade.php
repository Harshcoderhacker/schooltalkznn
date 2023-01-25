<div class="col-span-12 lg:col-span-12 2xl:col-span-12 mx-auto lg:w-5/12">
    <!-- BEGIN: Change Password -->
    <form wire:submit.prevent="changepassword">
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">Change Password</h2>
            </div>
            <div class="p-5">
                <div>
                    <label for="change-password-form-1" class="form-label font-semibold">Old Password</label>
                    <input id="change-password-form-1" wire:model="currentpassword" type="password"
                        class="form-control">
                    @error('currentpassword') <span class="text-primary-3">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="change-password-form-2" class="form-label font-semibold">New Password</label>
                    <input id="change-password-form-2" wire:model="password" type="password" class="form-control">
                    @error('password') <span class="text-primary-3">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="change-password-form-3" class="form-label font-semibold">Confirm New Password</label>
                    <input id="change-password-form-3" wire:model="password_confirmation" type="password"
                        class="form-control">
                    @error('password_confirmation') <span class="text-primary-3">{{ $message }}</span> @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">Change Password</button>
                    <span wire:click="onclickformreset" class="btn btn-danger mt-4">Cancel</span>
                </div>
            </div>
        </div>
    </form>
    <!-- END: Change Password -->
</div>
