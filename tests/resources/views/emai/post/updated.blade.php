@component('mail::message')
# Content

Your post has updated successfully!

@component('mail::button', ['url' => 'http://127.0.0.1:8000/blog'])
Check your post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
