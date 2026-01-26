<body>
    @include('layout.style')

    <aside>
        {{ auth()->user()->username }}
    </aside>

    <main>
        @yield('content')
    </main>

    @include('layout.script')
</body>
