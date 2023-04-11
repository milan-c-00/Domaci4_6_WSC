<x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create user') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <a class="btn btn-outline-dark mb-2" href="{{ url()->previous() }}">&lt; Back</a>
            <form class="w-50" action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="mt-2">
                    <input type="text" required placeholder="Name" name="name" class="form-control">
                    @error('name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <input type="email" required placeholder="E-mail" name="email" class="form-control">
                    @error('email')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <input type="password" required placeholder="Password" name="password" class="form-control">
                    @error('password')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <input type="password" required placeholder="Confirm password" name="password_confirmation" class="form-control">
                </div>
                <button type="submit" class="btn btn-success mt-2">Create</button>
            </form>
        </div>
    </div>
</x-app-layout>
