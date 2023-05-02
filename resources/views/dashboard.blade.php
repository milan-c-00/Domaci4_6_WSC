<x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(auth()->user()->role === 'admin')
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in to admin dashboard!") }}
                        <br>
                        {{ __("You can proceed to user management control panel now.") }}
                        <br>
                        {{ __("As a superadmin you are authorized to perform CRUD operations on all other users.") }}
                        <br>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-dark mt-2">Control panel</a>
                    </div>
                @else
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in to user dashboard!") }}
                        <br>
                        {{ __("As a user you are able to see other users, send friend requests and message friends.") }}
                        <br>
                        {{ __("Users are divided in friends, requested users and others.") }}
                        <br>
                        {{ __("Go and explore all features of this app!") }}
                        <br>
                        <a href="{{ route('people.others') }}" class="btn btn-outline-dark mt-2">People</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
