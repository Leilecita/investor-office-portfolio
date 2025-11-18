@include('components.head')

<body>
    @include('components.navbar')
    <section id="admin">
        @include('components.sidebar')
        <div id="content">
            @yield('content')
        </div>
    </section>
</body>

</html>