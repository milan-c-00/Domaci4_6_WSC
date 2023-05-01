<x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Friends') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container w-50">
            <table class="table text-center">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Message</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody>
                @foreach($friends as $friend)
                    <tr>
                        <td class="">{{ $friend->name }}</td>
                        <td class="">
                            <form method="POST" action="{{ route('people.addFriend', $friend->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Message</button>
                            </form>
                        </td>
                        <td class="">
                            <form method="POST" action="{{ route('people.removeFriend', $friend->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
