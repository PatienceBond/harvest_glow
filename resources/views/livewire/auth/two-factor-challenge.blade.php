<x-layouts.auth.harvestglow title="Two-Factor Authentication" description="Please verify your identity using your authenticator app or recovery code.">
    <div
        class="relative w-full h-auto"
        x-cloak
        x-data="{
            showRecoveryInput: @js($errors->has('recovery_code')),
            code: '',
            recovery_code: '',
            toggleInput() {
                this.showRecoveryInput = !this.showRecoveryInput;

                this.code = '';
                this.recovery_code = '';

                $dispatch('clear-2fa-auth-code');
        
                $nextTick(() => {
                    this.showRecoveryInput
                        ? this.$refs.recovery_code?.focus()
                        : $dispatch('focus-2fa-auth-code');
                });
            },
        }"
    >
        <div class="text-center space-y-6">
            <div x-show="!showRecoveryInput">
                <x-heroicon-o-device-phone-mobile class="w-16 h-16 text-primary mx-auto mb-4" />
                <h2 class="text-2xl font-bold text-foreground mb-2">Authentication Code</h2>
                <p class="text-muted-foreground">
                    Enter the authentication code provided by your authenticator application.
                </p>
            </div>

            <div x-show="showRecoveryInput">
                <x-heroicon-o-key class="w-16 h-16 text-primary mx-auto mb-4" />
                <h2 class="text-2xl font-bold text-foreground mb-2">Recovery Code</h2>
                <p class="text-muted-foreground">
                    Please confirm access to your account by entering one of your emergency recovery codes.
                </p>
            </div>

            <form method="POST" action="{{ route('two-factor.login.store') }}" class="space-y-6">
                @csrf

                <div class="space-y-5 text-center">
                    <div x-show="!showRecoveryInput">
                        <div class="flex items-center justify-center my-5">
                            <x-input-otp
                                name="code"
                                digits="6"
                                autocomplete="one-time-code"
                                x-model="code"
                            />
                        </div>

                        @error('code')
                            <div class="p-4 bg-destructive/10 border border-destructive/20 rounded-lg text-destructive text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div x-show="showRecoveryInput">
                        <div class="my-5">
                            <label for="recovery_code" class="block text-sm font-medium mb-2">Recovery Code</label>
                            <input
                                type="text"
                                name="recovery_code"
                                id="recovery_code"
                                x-ref="recovery_code"
                                x-bind:required="showRecoveryInput"
                                autocomplete="one-time-code"
                                x-model="recovery_code"
                                class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                placeholder="Enter recovery code"
                            />
                        </div>

                        @error('recovery_code')
                            <div class="p-4 bg-destructive/10 border border-destructive/20 rounded-lg text-destructive text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <x-ui.loading-button type="submit" class="w-full" loadingText="Verifying...">
                        Continue
                    </x-ui.loading-button>
                </div>

                <div class="mt-5 text-center text-sm text-muted-foreground">
                    <span>or you can </span>
                    <button type="button" @click="toggleInput()" class="font-medium text-primary hover:text-primary/80 transition-colors underline">
                        <span x-show="!showRecoveryInput">login using a recovery code</span>
                        <span x-show="showRecoveryInput">login using an authentication code</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.auth.harvestglow>
