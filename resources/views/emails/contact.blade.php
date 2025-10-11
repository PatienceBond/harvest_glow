<x-mail::message>
# New Contact Form Message

You have received a new message from the HarvestGlow website contact form.

**From:** {{ $name }}  
**Email:** {{ $email }}  
**Subject:** {{ $contactSubject }}

## Message:

{{ $messageContent }}

---

You can reply directly to this email to respond to {{ $name }}.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
