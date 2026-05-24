<x-mail::message>
# New Contact Message

You received a new message from the blog contact form.

**Name:** {{ $contact->name }}

**Email:** {{ $contact->email }}

**Subject:** {{ $contact->subject }}

**Message:**

{{ $contact->message }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
