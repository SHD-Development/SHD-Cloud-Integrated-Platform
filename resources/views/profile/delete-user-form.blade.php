<x-action-section>
    <x-slot name="title">
        {{ __('刪除帳號') }}
    </x-slot>

    <x-slot name="description">
        {{ __('永久刪除您的帳號') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('一旦您刪除了帳號，您的所有資料都會永久的消失，無法恢復。') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('刪除帳號') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('刪除帳號') }}
            </x-slot>

            <x-slot name="content">
                {{ __('您確定要刪除帳號嗎，這個動作是不可逆的，一旦執行，您所有資料都會消失，無法再復原。請輸入密碼已確認您真的要刪除帳號。') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4"
                                autocomplete="current-password"
                                placeholder="{{ __('密碼') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('取消') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('確認刪除') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
