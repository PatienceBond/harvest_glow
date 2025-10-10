<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.dashboard.dashboard-layout')] class extends Component {
    //
}; ?>

<div class="py-8 px-6">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-foreground">Settings</h1>
            <p class="text-muted-foreground mt-2">Manage your profile and account settings</p>
        </div>

        <x-settings.layout :heading="__('Appearance')" :subheading=" __('Update the appearance settings for your account')">
            <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
                <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
                <flux:radio value="system" icon="computer-desktop">{{ __('System') }}</flux:radio>
            </flux:radio.group>
        </x-settings.layout>
    </div>
</div>
