@include('components.head')
<body>
    @include('components.navbar')
    <section id="app">
        <div class="container">
            @yield('content')
        </div>
    </section>
</body>
</html>
