<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1280">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \Laravel\Nova\Nova::name() }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/nova') }}">

    <!-- Tool Styles -->
    @foreach(\Laravel\Nova\Nova::availableStyles(request()) as $name => $path)
        @if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://']))
            <link rel="stylesheet" href="{!! $path !!}">
        @else
            <link rel="stylesheet" href="/nova-api/styles/{{ $name }}">
        @endif
    @endforeach

<!-- Custom Meta Data -->
    @include('nova::partials.meta')

<!-- Theme Styles -->
    @foreach(\Laravel\Nova\Nova::themeStyles() as $publicPath)
        <link rel="stylesheet" href="{{ $publicPath }}">
    @endforeach
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.17/tailwind.min.css">--}}
</head>
<body class="min-w-site bg-40 text-90 font-medium min-h-full">
<div id="nova">
    <div v-cloak class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="min-h-screen flex-none pt-header min-h-screen w-sidebar bg-grad-sidebar px-6">
            <a href="{{ \Laravel\Nova\Nova::path() }}">
                <div class="absolute pin-t pin-l pin-r bg-logo flex items-center w-sidebar h-header px-6 text-white">
                    @include('nova::partials.logo')
                </div>
            </a>
            <div class="navigation-elements">
                @foreach (\Laravel\Nova\Nova::availableTools(request()) as $tool)
                    @if(!($tool instanceof \SaintSystems\Nova\ResourceGroupMenu\ResourceGroupMenu))
                        {!! $tool->renderNavigation() !!}
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="flex items-center relative shadow h-header bg-white z-20 px-view">
                <a v-if="@json(\Laravel\Nova\Nova::name() !== null)" href="{{ config('app.url') }}"
                   class="no-underline font-bold text-90 mr-6">
                    <img src="{{ asset('storage/logo.png') }}" width="{{ $width ?? '126' }}"
                         height="{{ $height ?? '24' }}">
                </a>
                <ul class="list-reset flex items-center">
                    <li class="leading-tight ml-8 text-sm">
                        <a class="text-black text-justify no-underline dim"
                           href="{{ config('app.url') }}/resources/customers">Müştərilər</a>
                    </li>
                    <li class="leading-tight ml-8 text-sm">
                        <a class="text-black text-justify no-underline dim" href="#">Tranzaksiyalar</a>
                    </li>
                    <li class="leading-tight ml-8 text-sm">
                        <a class="text-black text-justify no-underline dim" href="#">Mühasibatlıq</a>
                    </li>
                    <li class="leading-tight ml-8 text-sm">
                        <a class="text-black text-justify no-underline dim" href="#">
                        <div class="flex items-center justify-center">
                            <div class="relative inline-block text-left dropdown">
                            <span class="rounded-md shadow-sm dim">
                                <button
                                    class="flex items-center justify-center w-full dim font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800"
                                    type="button" aria-haspopup="true" aria-expanded="true"
                                    aria-controls="headlessui-menu-items-117">
                                    <span>Hesabatar</span>
                                    <svg class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"><path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path></svg>
                                </button>
                            </span>
                                <div
                                    class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
                                    <div
                                        class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                        aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117"
                                        role="menu">
                                        <div class="px-4 py-3">
                                            <p class="text-sm leading-5">Signed in as</p>
                                            <p class="text-sm font-medium leading-5 text-gray-900 truncate">
                                                tom@example.com</p>
                                        </div>
                                        <div class="py-1">
                                            <a href="javascript:void(0)" tabindex="0"
                                               class="text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left"
                                               role="menuitem">Account settings</a>
                                            <a href="javascript:void(0)" tabindex="1"
                                               class="text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left"
                                               role="menuitem">Support</a>
                                            <span role="menuitem" tabindex="-1"
                                                  class="flex justify-between w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 cursor-not-allowed opacity-50"
                                                  aria-disabled="true">New feature (soon)</span>
                                            <a href="javascript:void(0)" tabindex="2"
                                               class="text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left"
                                               role="menuitem">License</a></div>
                                        <div class="py-1">
                                            <a href="javascript:void(0)" tabindex="3"
                                               class="text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left"
                                               role="menuitem">Sign out</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </li>
                </ul>
                {{--                    @if (count(\Laravel\Nova\Nova::globallySearchableResources(request())) > 0)--}}

                {{--                        <global-search dusk="global-search-component"></global-search>--}}
                {{--                    @endif--}}
                <dropdown class="ml-auto h-9 flex items-center dropdown-right">
                    @include('nova::partials.user')
                </dropdown>
            </div>

            <div data-testid="content" class="px-view py-view mx-auto">
                @yield('content')

                @include('nova::partials.footer')
            </div>
        </div>
    </div>
</div>

<script>
    window.config = @json(\Laravel\Nova\Nova::jsonVariables(request()));
</script>

<!-- Scripts -->
<script src="{{ mix('manifest.js', 'vendor/nova') }}"></script>
<script src="{{ mix('vendor.js', 'vendor/nova') }}"></script>
<script src="{{ mix('app.js', 'vendor/nova') }}"></script>

<!-- Build Nova Instance -->
<script>
    window.Nova = new CreateNova(config)
</script>

<!-- Tool Scripts -->
@foreach (\Laravel\Nova\Nova::availableScripts(request()) as $name => $path)
    @if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://']))
        <script src="{!! $path !!}"></script>
    @else
        <script src="/nova-api/scripts/{{ $name }}"></script>
    @endif
@endforeach

<!-- Start Nova -->
<script>
    Nova.liftOff()

</script>
</body>
</html>
