<x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <a class="btn btn-outline-dark mb-2" href="{{ url()->previous() }}">&lt; Back</a>
            <div class="card w-50">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <hr>
                    <p class="card-text">User email: {{ $user->email }}</p>
                    <p class="card-text">Creation date: {{ $user->created_at }}</p>
                    <p class="card-text">Last update: {{ $user->updated_at }}</p>
                    <a href="mailto:{{$user->email}}" class="btn btn-primary">Send mail</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
