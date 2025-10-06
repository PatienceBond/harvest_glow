<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? 'HarvestGlow - Empowering farmers, Growing futures' }}</title>
<meta name="description" content="{{ $metaDescription ?? 'Transforming agriculture through sustainable practices, innovative technology, and community-driven solutions that empower farmers and strengthen food security.' }}" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $ogType ?? 'website' }}" />
<meta property="og:url" content="{{ $ogUrl ?? request()->url() }}" />
<meta property="og:title" content="{{ $ogTitle ?? $title ?? 'HarvestGlow - Empowering farmers, Growing futures' }}" />
<meta property="og:description" content="{{ $ogDescription ?? $metaDescription ?? 'Transforming agriculture through sustainable practices, innovative technology, and community-driven solutions that empower farmers and strengthen food security.' }}" />
<meta property="og:image" content="{{ $ogImage ?? asset('images/landing-farm.jpg') }}" />
<meta property="og:site_name" content="HarvestGlow" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:title" content="{{ $ogTitle ?? $title ?? 'HarvestGlow - Empowering farmers, Growing futures' }}" />
<meta property="twitter:description" content="{{ $ogDescription ?? $metaDescription ?? 'Transforming agriculture through sustainable practices, innovative technology, and community-driven solutions that empower farmers and strengthen food security.' }}" />
<meta property="twitter:image" content="{{ $ogImage ?? asset('images/landing-farm.jpg') }}" />

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="manifest" href="/site.webmanifest">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance