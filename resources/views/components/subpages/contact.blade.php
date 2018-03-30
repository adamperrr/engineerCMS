@php
$url = env('APP_URL');
@endphp
<send_email token="{{ csrf_token() }}" subpage="{{ $subpage->id }}" appurl="{{ $url }}"></send_email>