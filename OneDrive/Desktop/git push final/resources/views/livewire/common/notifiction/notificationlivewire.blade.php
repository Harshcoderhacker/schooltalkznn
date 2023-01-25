<div>
    <div class="intro-x dropdown w-8 h-8 p-2 mr-2">
        <div class="dropdown-toggle notification {{ isset($user) && $user->unreadNotifications->count() > 0 ? 'notification--bullet' : '' }} cursor-pointer"
            role="button" aria-expanded="false" data-tw-toggle="dropdown" wire:click="notificationsread">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-bell notification__icon dark:text-slate-500">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
        </div>
        <div
            class="notification-content pt-2 dropdown-menu h-1/2 overflow-y-scroll overscroll-none notificationdropdown">
            <div class="notification-content__box dropdown-content">
                <div class="notification-content__title">Notifications</div>
                @if ( isset($user) && $user->notifications()->count() > 0)
                    <div class="text-center mb-3 text-sm">
                        You have {{ $user->unreadNotifications->count() }} unread notifications
                    </div>
                    @include(
                        'livewire.common.notifiction.notificationlist',
                        ['pagination' => false]
                    )
                    @if ($user->notifications()->count() > 15)
                        <button data-tw-dismiss="dropdown" wire:click="$set('openallnotificationsmodal', true)"
                            class="mt-2 text-slate-600 dark:text-slate-500 p-3 hover:underline">
                            Show All Notification
                        </button>
                    @endif
                @else
                    <div class="text-center">
                        No Notifications...
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if ($openallnotificationsmodal)
        <div class="fixed inset-0 z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="right-0 left-0 z-50 justify-center items-center h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex"
            style="z-index:10000;">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-1/3 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        Notifications
                    </h3>
                    <button wire:click="$set('openallnotificationsmodal', false)"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-6 overflow-y-scroll overscroll-none notificationdropdown"
                    style="height: 20rem;">
                    @include(
                        'livewire.common.notifiction.notificationlist',
                        ['pagination' => true]
                    )
                </div>
                @if ($user->notifications()->count() > 15 && $paginate < $user->notifications()->count())
                    <div class="text-center">
                        <button wire:click="paginate">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus-circle">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="16"></line>
                                <line x1="8" y1="12" x2="16" y2="12"></line>
                            </svg>
                        </button>
                    </div>
                @endif
                <div
                    class="flex flex-row-reverse items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <button type="button" wire:click="$set('openallnotificationsmodal', false)"
                        class="btn btn-primary">Cloase</button>
                </div>
            </div>
        </div>
    @endif
</div>
