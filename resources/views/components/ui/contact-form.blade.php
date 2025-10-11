<form wire:submit="submitContactForm" {{ $attributes->merge(['class' => 'space-y-6']) }}>
    
    <!-- Name Field -->
    <flux:input 
        wire:model="name"
        type="text"
        label="Name"
        placeholder="Your name"
        required
    />

    <!-- Email Field -->
    <flux:input 
        wire:model="email"
        type="email"
        label="Email"
        placeholder="Your email address"
        required
    />

    <!-- Subject Field -->
    <flux:input 
        wire:model="subject"
        type="text"
        label="Subject"
        placeholder="Subject of your message"
        required
    />

    <!-- Message Field -->
    <flux:textarea 
        wire:model="message"
        label="Message"
        placeholder="Your message"
        rows="6"
        required
    />

    <!-- Submit Button -->
    <div class="flex justify-end">
        <flux:button 
            type="submit" 
            variant="primary"
            class="px-8"
        >
            <span wire:loading.remove wire:target="submitContactForm">Send Message</span>
            <span wire:loading wire:target="submitContactForm">Sending...</span>
        </flux:button>
    </div>
</form>
