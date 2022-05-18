<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'C8') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        @include('sweetalert::alert')
    </div>
    <script src="{{ asset('js/subscribers.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script>
        const groups = [];
        const modal = document.querySelector("#modal");
        const modalOverlay = document.querySelector("#modal-overlay");
        const openButton = document.querySelector("#open-button");
        const closeButton = document.querySelector("#close-button");


        if(openButton != undefined){
            openButton.addEventListener("click", () => {
                modal.classList.toggle("closed");
                modalOverlay.classList.toggle("closed");
            })
        }

        function openModal(name, number){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                @if (auth()->user()->is_admin)
                    url: "{{ route('admin.dashboard.groups') }}",
                @else
                    url: "{{ route('user.dashboard.groups') }}",
                @endif
                    type: "POST",
                    data: {
                        name: name,
                        number: number
                    },
                    success: function(response) {
                        var span_container = document.getElementById('span-container');
                        span_container.textContent = '';
                        data = $.parseJSON(JSON.stringify(response));
                        groups.length = 0;
                        Object.values(data.groups).forEach(val => {
                            groups.push(val.GROUP_ID);
                        });
                        valueToSpan(data.name, data.number);
                    }
            });
            modal.classList.toggle("closed");
            modalOverlay.classList.toggle("closed");
        }


        // Display GROUP_ID to modal in dashboard
        function valueToSpan(name, number) {
            var modal_name = document.getElementById("modal-name"); 
            modal_name.innerHTML = name+"'s Info";
            var modal_number = document.getElementById("modal-number"); 
            modal_number.value = number;
            for (var i = 0; i < groups.length; i++){
                var newSpan = document.createElement('span');
                newSpan.setAttribute('class', 'bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-sm w-fit');
                document.getElementById('span-container').appendChild(newSpan);
                newSpan.innerHTML = groups[i];
            }
        }

        function closeModal() {
            modal.classList.toggle("closed");
            modalOverlay.classList.toggle("closed");
        }
    </script>
</body>

</html>