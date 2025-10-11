<?php

namespace App\Livewire\Guests;

use App\Mail\ContactMail;
use App\Models\HeroSection;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest.guest-layout')]
class Contact extends Component
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';
    public $heroSection;

    protected $rules = [
        'name' => 'required|string|min:2|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|min:3|max:255',
        'message' => 'required|string|min:10|max:5000',
    ];

    protected $messages = [
        'name.required' => 'Please enter your name.',
        'name.min' => 'Name must be at least 2 characters.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'subject.required' => 'Please enter a subject.',
        'subject.min' => 'Subject must be at least 3 characters.',
        'message.required' => 'Please enter your message.',
        'message.min' => 'Message must be at least 10 characters.',
    ];

    public function mount()
    {
        // Fetch hero section for contact page
        $this->heroSection = cache()->remember('contact.hero', 3600, function () {
            return HeroSection::forPage('contact');
        });
    }

    public function submitContactForm()
    {
        try {
            $validated = $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Show validation error toast
            $this->dispatch('showToast', message: 'Please check the form for errors.', type: 'error');
            throw $e;
        }

        try {
            // Send email to your organization's email
            Mail::to(config('mail.from.address'))
                ->send(new ContactMail(
                    name: $validated['name'],
                    email: $validated['email'],
                    contactSubject: $validated['subject'],
                    messageContent: $validated['message'],
                ));

            // Reset form fields
            $this->reset(['name', 'email', 'subject', 'message']);

            // Show success message (both inline and toast)
            session()->flash('success', 'Thank you for your message! We\'ll get back to you soon.');
            $this->dispatch('showToast', message: 'Message sent successfully! We\'ll get back to you soon.', type: 'success');

            // Scroll to top to show the success message
            $this->dispatch('scroll-to-top');

        } catch (\Exception $e) {
            // Log the error
            logger()->error('Contact form email failed: ' . $e->getMessage());

            // Show error message to user (both inline and toast)
            session()->flash('error', 'Sorry, there was an error sending your message. Please try again or contact us directly at info@harvestglow.org.');
            $this->dispatch('showToast', message: 'Failed to send message. Please try again.', type: 'error');
        }
    }

    public function render()
    {
        return view('livewire.guests.contact');
    }
}
