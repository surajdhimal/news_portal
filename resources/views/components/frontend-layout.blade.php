<!DOCTYPE html>
<html lang="en">
@props(['meta_keywords', 'meta_description', 'title'])
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? "Jawaaf News" }}</title>

    {{-- For SEO --}}
    <meta name="keywords" content="{{ $meta_keywords ?? 'jawaaf news portal, nepali news, breaking news, latest news, top stories' }}">
    <meta name="description" content="{{ $meta_description ?? 'Stay updated with the latest Nepali news, politics, entertainment, sports, and more on Jawaaf News Portal' }} ">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta name="author" content="Jawaaf News">
    <link rel="canonical" href="{{ Request::url() }}" />
    <meta property="og:title" content="{{ $title ?? 'Jawaaf News - Latest News in Nepal' }}" />
    <meta property="og:site_name" content="Jawaaf News" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:image" content="https://example.com/path-to-your-image.jpg" />
    <meta property="og:description" content="{{ $meta_description ?? 'Get the latest updates and breaking news from Nepal on Jawaaf News Portal.' }}" />

    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "NewsArticle",
          "headline": "Jawaaf News - Latest Updates",
          "url": "https://jawaafnews.com/",
          "publisher": {
            "@type": "Organization",
            "name": "Jawaaf News",
            "logo": "https://jawaafnews.com/logo.png"
          },
          "image": "https://example.com/your-image.jpg",
          "datePublished": "2025-02-17",
          "dateModified": "2025-02-17"
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
    <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=64a5157b9c5ef40019022723&product=image-share-buttons'
        async='async'></script>
</head>
<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v22.0"></script>

    <header class="sticky top-0 bg-white z-50">
        <x-frontend-navbar/>
    </header>

    <main>
        <!-- Add the main news content here -->
        {{ $slot }}
    </main>

    <footer></footer>
</body>
</html>
