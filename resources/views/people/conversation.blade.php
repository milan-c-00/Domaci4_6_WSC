<x-app-layout>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container w-50">
            <div class="d-inline-flex w-100">
                <h4 class="text-secondary col-10">Conversation with {{ $friend->name }}</h4>
                <form class="col-2 ms-auto d-inline-flex align-items-end" method="POST" action="{{ route('friend.deleteConversation', $friend->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-secondary ms-auto delete-btn" id="del-conv">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                        </svg>
                    </button>
                </form>
            </div>
            <div class="border rounded mt-2">
                <div class="conversation " id="myScrollableDiv">
                    @if($messages->isempty())
                        <h6 class="text-secondary text-center">No messages yet!</h6>
                    @endif
                    @foreach($messages as $message)
                        <div class="{{ $message->sender_id == auth()->id() ? ' ms-auto' : ' me-auto' }}">
                            <div class="mt-2 align-middle message{{ $message->sender_id == auth()->id() ? ' ms-auto text-right user' : ' me-auto text-left friend' }}">

                                @if($message->sender_id == auth()->id())
                                    <span class="msg rounded-4 p-1">{{ $message->message_content }}</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                        </svg>
                                    </span>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                    </svg>
                                    <span class="msg rounded-4 p-1">{{ $message->message_content }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="w-100">
                <form class="w-100" method="POST" action="{{ route('friend.sendMessage', $friend->id) }}">
                    @csrf
                    <input type="hidden" name="sender_id" class="form-control" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="receiver_id" class="form-control" value="{{ $friend->id }}">
                    <div class="col-11 input-group">
                        <input type="text" name="message_content" class="form-control" placeholder="Message" aria-describedby="button-addon2">
                        <button class="btn btn-outline-primary col-1" type="submit" id="button-addon2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                            </svg>
                        </button>
                    </div>

                </form>
                @error('message_content')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>

</x-app-layout>
<script>
    setTimeout(() => {
        let myDiv = document.getElementById("myScrollableDiv");
        myDiv.scrollTop = myDiv.scrollHeight;
    }, 0);
</script>
