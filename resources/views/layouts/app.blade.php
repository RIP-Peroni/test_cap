<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
    integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <!-- Styles -->
    <livewire:styles />
    <livewire:scripts />
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>
</head>
<body class="flex flex-wrap content-start justify-center">
    <div class="flex max-h-16 w-full justify-between px-4 bg-purple-900 text-white">
        <a href="/" class="mx-3 py-4">Home</a>
        @auth
            <livewire:logout />
        @endauth

        @guest
            <div class="py-4">
                <a href="{{ route('login') }}" class="mx-3">Login</a>
                <a href="{{ route('register') }}" class="mx-3">Register</a>
            </div>
        @endguest
    </div>
    <div class="my-5 w-full flex justify-center">
        {{ $slot }}
    </div>
</body>