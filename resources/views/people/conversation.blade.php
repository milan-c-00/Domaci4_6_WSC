<x-app-layout>



    <style>
        .conversation {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        .message-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .message-container.user {
            align-items: flex-end;
        }
        .message {
            padding: 10px;
            border-radius: 10px;
            font-size: 16px;
            max-width: 80%;
        }
        .message.user {
            background-color: #3498db;
            color: #fff;
        }
        .message span.timestamp {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container w-50">
            <div class="border rounded">
                <div class="conversation">
                    @foreach($messages as $message)
                        <div class="message-container{{ $message->sender_id == auth()->id() ? ' ms-auto' : ' me-auto' }}">
                            <div class="message{{ $message->sender_id == auth()->id() ? ' me-auto' : ' ms-auto' }}">
                                <p>{{ $message->message_content }}</p>
{{--                                <span class="timestamp">{{ $message->created_at->format('Y-m-d H:i:s') }}</span>--}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="row">
                <form class="col-10" method="POST" action="{{ route('friend.sendMessage', $friend->id) }}">
                    @csrf
                    <input type="hidden" name="sender_id" class="form-control" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="receiver_id" class="form-control" value="{{ $friend->id }}">
                    <input type="text" name="message_content" class="form-control" placeholder="Message">
                </form>
                <button class="btn btn-success col-2">Send</button>
            </div>
        </div>

    </div>
</x-app-layout>
