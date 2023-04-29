<x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Friend requests') }}
        </h2>
    </x-slot>

    <div class="py-12 container row mx-auto">

        <div class=" col-6">
            <h3 class="text-center">Sent requests</h3>
            <table class="table text-center">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Remove request</th>
                </tr>
                </thead>
                <tbody>
                @foreach($requests_to as $request_to)
                    <tr>
                        <td class="">{{ $request_to->name }}</td>
                        <td class="">
                            <form method="POST" action="{{ route('people.removeRequest', $request_to->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class=" col-6">
            <h3 class="text-center">Received requests</h3>
            <table class="table text-center">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Accept</th>
                    <th>Decline</th>
                </tr>
                </thead>
                <tbody>
                @foreach($requests_from as $request_from)
                    <tr>
                        <td class="">{{ $request_from->name }}</td>
                        <td class="">
                            <form method="POST" action="{{ route('people.acceptRequest', $request_from->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">Accept</button>
                            </form>
                        </td>
                        <td class="">
                            <form method="POST" action="{{ route('people.declineRequest', $request_from->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Decline</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
