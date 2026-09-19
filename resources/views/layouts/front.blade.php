<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', __('front.page_title'))</title>
<meta name="description" content="@yield('meta_description', __('front.meta_description'))">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&family=IBM+Plex+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<link href="{{ asset('assets_front/css/style.css') }}" rel="stylesheet">
@stack('styles')
</head>
<body class="{{ app()->getLocale() === 'en' ? 'lang-en' : 'lang-ar' }}">

<!-- ======= NAV ======= -->
@include('front.includes.navbar')

<!-- ======= CONTENT ======= -->
@yield('content')

<!-- ======= FOOTER ======= -->
@include('front.includes.footer')
<a class="wa-fab" href="https://wa.me/962785171895" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
  <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M17.6 6.32A7.85 7.85 0 0 0 12.04 4c-4.34 0-7.87 3.53-7.87 7.87 0 1.39.36 2.74 1.05 3.93L4.08 20l4.32-1.13a7.9 7.9 0 0 0 3.64.89h.01c4.34 0 7.87-3.53 7.87-7.87a7.83 7.83 0 0 0-2.32-5.57Zm-5.56 12.1h-.01a6.6 6.6 0 0 1-3.34-.92l-.24-.14-2.48.65.66-2.42-.16-.25a6.55 6.55 0 0 1-1-3.47 6.58 6.58 0 0 1 6.6-6.58 6.55 6.55 0 0 1 4.66 1.93 6.53 6.53 0 0 1 1.94 4.66c0 3.63-2.96 6.54-6.63 6.54Zm3.6-4.9c-.2-.1-1.17-.58-1.35-.64-.18-.07-.31-.1-.44.1-.13.2-.5.64-.62.77-.11.13-.23.15-.42.05-.2-.1-.83-.31-1.58-.98a5.9 5.9 0 0 1-1.1-1.36c-.11-.2 0-.3.09-.4.09-.1.2-.24.3-.36.1-.12.13-.2.2-.34.07-.13.03-.25-.02-.35-.05-.1-.44-1.06-.6-1.45-.16-.38-.32-.33-.44-.33h-.37c-.13 0-.34.05-.52.24-.18.2-.68.67-.68 1.63s.7 1.9.8 2.03c.1.13 1.37 2.1 3.33 2.94.46.2.83.32 1.11.41.47.15.9.13 1.24.08.38-.06 1.17-.48 1.33-.94.16-.46.16-.86.11-.94-.05-.09-.18-.14-.38-.24Z" fill="#fff"/>
  </svg>
</a>


<script src="{{ asset('assets_front/js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
