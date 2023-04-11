<x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" container mb-2">
            <a class="btn btn-success col-2" href="{{ route('users.create') }}">Create user</a>
        </div>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="col-2">{{ $user->name }}</td>
                            <td class="col-2">{{ $user->email }}</td>
                            <td class="col-2">{{ $user->created_at }}</td>
                            <td class="col-2">{{ $user->updated_at }}</td>
                            <td class="col-4">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary col-12">Show</a>
                                    </div>
                                    <div class="col-4">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-warning col-12">Edit</a>
                                    </div>
                                    <form class="col-4" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="currentPage" value="{{ $users->currentPage()}}">
                                        <input type="hidden" name="total" value="{{ $users->total()}}">
                                        <input type="hidden" name="perPage" value="{{ $users->perPage()}}">
                                        <button class="btn btn-outline-danger col-12">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
