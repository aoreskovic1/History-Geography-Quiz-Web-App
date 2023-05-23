<x-app-layout>
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <h2 id='info' class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @php if(isset($info)) echo $info; @endphp
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100 p-5">
                    <h1 class='h2'>Leaderboard</h1>

                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Incoming Challenges</h4>
                                <button id='closeButton' type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <p>You have been challenged by user <span id='challenger' class='font-italic'></span></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-blue-500 hover:bg-blue-700" id="acceptButton">Accept</button>
                                <button type="button" class="btn bg-red-500 hover:bg-red-700" id="denyButton">Deny</button>
                            </div>
                            </div>
                        </div>
                    </div>


                    <div class="">
                        <div class="">
                          <div class="card w-75">
                            <div class="card-body">
                              <div id='message-list' class="message-list overflow-auto" style="max-height: 200px;">

                                @foreach ($messages as $message)
                                @php
                                    $author = $message->author->name;
                                    if($message->user_id == Auth::user()->id){
                                        $author = "You";
                                    }
                                @endphp
                                    <div id='{{$message->id}}' class="message">
                                        <div class="message-text"><strong>{{$author}}:</strong> {{$message->message}}</div>
                                        <small class="message-time">{{$message->created_at}}</small>
                                        <hr>
                                    </div>
                                @endforeach

                            </div>
                              <div>
                                <div class="input-group">
                                  <input id='message-input' name='message' type="text" class="form-control" placeholder="Type a message">
                                  <div class="input-group-append">
                                    <button id='messageButton' class="btn bg-blue-500 hover:bg-blue-700 ml-5 mt-3 text-white">Send</button>
                                  </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>




                    <ul class="list-group list-group-flush w-50 mt-5">
                        @foreach ($users as $user)
                        <li class="list-group-item d-flex flex-row justify-content-between">
                            <p>{{$user->getScore()}}</p>
                            <p>{{$user->name}}</p>

                            @if (auth()->user()->id == $user->id)

                            <span class="bg-gray-500 text-white font-bold py-2 px-4 rounded">
                                This is you
                            </span>
                            @elseif ($user->active())
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick='challengeUser({{$user->id}})'>
                                    Challenge
                                </button>
                            @else
                            <span class="bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                &nbsp;&nbsp;&nbsp;Offline&nbsp;&nbsp;&nbsp;
                            </span>
                            @endif
                        </li>
                        @endforeach
                      </ul>

                </div>
            </div>
        </div>
    </div>
    @include('javascript.API')
</x-app-layout>
