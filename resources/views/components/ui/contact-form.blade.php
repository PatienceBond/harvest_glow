@props([
    'action' => '#',
    'method' => 'POST'
])

<form action="{{ $action }}" method="{{ $method }}" {{ $attributes->merge(['class' => 'space-y-6']) }}>
    @csrf
    
    <!-- Name Field -->
    <div>
        <label for="name" class="block text-sm font-medium mb-2">Name</label>
        <input type="text" id="name" name="name" required
               class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
               placeholder="Your name">
    </div>
    
    <!-- Email Field -->
    <div>
        <label for="email" class="block text-sm font-medium mb-2">Email</label>
        <input type="email" id="email" name="email" required
               class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
               placeholder="Your email address">
    </div>

    <!-- Subject Field -->
    <div>
        <label for="subject" class="block text-sm font-medium mb-2">Subject</label>
        <input type="text" id="subject" name="subject" required
               class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
               placeholder="Subject of your message">
    </div>

    <!-- Message Field -->
    <div>
        <label for="message" class="block text-sm font-medium mb-2">Message</label>
        <textarea id="message" name="message" rows="6" required
                  class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent resize-none"
                  placeholder="Your message"></textarea>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end">
        <button type="submit" 
                class="bg-primary text-white px-8 py-3 rounded-lg hover:bg-primary/90 transition-colors font-medium">
            Send Message
        </button>
    </div>
</form>
