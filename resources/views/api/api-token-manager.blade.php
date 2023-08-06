<div>
    <!-- Generate API Token -->
    <x-form-section submit="createApiToken">
        <x-slot name="title">
            {{ __('創建API金鑰') }}
        </x-slot>

        <x-slot name="description">
            {{ __('此為用於帳號操作的API金鑰，並非用於存取本系統API服務的金鑰') }}
        </x-slot>

        <x-slot name="form">
            <!-- Token Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('金鑰名稱') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="createApiTokenForm.name" autofocus />
                <x-input-error for="name" class="mt-2" />
            </div>

            <!-- Token Permissions -->
            @if (Laravel\Jetstream\Jetstream::hasPermissions())
                <div class="col-span-6">
                    <x-label for="permissions" value="{{ __('權限') }}" />

                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                            <label class="flex items-center">
                                <x-checkbox wire:model.defer="createApiTokenForm.permissions" :value="$permission"/>
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $permission }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="mr-3" on="created">
                {{ __('已創建。') }}
            </x-action-message>

            <x-button>
                {{ __('創建') }}
            </x-button>
        </x-slot>
    </x-form-section>

    @if ($this->user->tokens->isNotEmpty())
        <x-section-border />

        <!-- Manage API Tokens -->
        <div class="mt-10 sm:mt-0">
            <x-action-section>
                <x-slot name="title">
                    {{ __('管理API金鑰') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('您可以管理或刪除您創建的API金鑰') }}
                </x-slot>

                <!-- API Token List -->
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($this->user->tokens->sortBy('name') as $token)
                            <div class="flex items-center justify-between">
                                <div class="break-all dark:text-white">
                                    {{ $token->name }}
                                </div>

                                <div class="flex items-center ml-2">
                                    @if ($token->last_used_at)
                                        <div class="text-sm text-gray-400">
                                            {{ __('最後使用') }} {{ $token->last_used_at->diffForHumans() }}
                                        </div>
                                    @endif

                                    @if (Laravel\Jetstream\Jetstream::hasPermissions())
                                        <button class="cursor-pointer ml-6 text-sm text-gray-400 underline" wire:click="manageApiTokenPermissions({{ $token->id }})">
                                            {{ __('權限') }}
                                        </button>
                                    @endif

                                    <button class="cursor-pointer ml-6 text-sm text-red-500" wire:click="confirmApiTokenDeletion({{ $token->id }})">
                                        {{ __('刪除') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    @endif

    <!-- Token Value Modal -->
    <x-dialog-modal wire:model="displayingToken">
        <x-slot name="title">
            {{ __('API金鑰') }}
        </x-slot>

        <x-slot name="content">
            <div>
                {{ __('請複製並妥善存放，此金鑰不會再次顯示。') }}
            </div>

            <x-input x-ref="plaintextToken" type="text" readonly :value="$plainTextToken"
                class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500 w-full break-all"
                autofocus autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                @showing-token-modal.window="setTimeout(() => $refs.plaintextToken.select(), 250)"
            />
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
                {{ __('關閉') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <!-- API Token Permissions Modal -->
    <x-dialog-modal wire:model="managingApiTokenPermissions">
        <x-slot name="title">
            {{ __('API金鑰權限') }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                    <label class="flex items-center">
                        <x-checkbox wire:model.defer="updateApiTokenForm.permissions" :value="$permission"/>
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $permission }}</span>
                    </label>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('managingApiTokenPermissions', false)" wire:loading.attr="disabled">
                {{ __('取消') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="updateApiToken" wire:loading.attr="disabled">
                {{ __('儲存') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Delete Token Confirmation Modal -->
    <x-confirmation-modal wire:model="confirmingApiTokenDeletion">
        <x-slot name="title">
            {{ __('刪除API金鑰') }}
        </x-slot>

        <x-slot name="content">
            {{ __('您確定您要刪除此API金鑰？') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingApiTokenDeletion')" wire:loading.attr="disabled">
                {{ __('取消') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="deleteApiToken" wire:loading.attr="disabled">
                {{ __('刪除') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
