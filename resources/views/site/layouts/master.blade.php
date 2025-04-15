<!DOCTYPE html>
<html lang="en" dir="rtl" class="js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms no-csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths">
<head>
    @include('site.layouts.head-tag')

    @yield('head-tag')
</head>
<body class="">

    @include('site.layouts.header')

    <main class="main">
        @yield('content')
    </main>

    @include('site.layouts.footer')
    @include('site.layouts.scripts')

    @yield('scripts')

</body>
</html>
