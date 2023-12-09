<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/admin/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/admin/css/core.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/admin/css/components.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/admin/css/colors.min.css') }}" rel="stylesheet" type="text/css">
@production
    @php
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
    @endphp
    <link type="module" href="/build/{{ $manifest['resources/css/app.css']['file'] }}">
    @else
        @vite(['resources/css/app.css'])
        @endproduction
