    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100 p-5">
                    @if($challenger)
                        <h1 class='h2 mb-5'>You were playing against {{$challenger->name}}</h1>
                    @else
                        <h1 class='h2 mb-5'>The other player has left the game.</h1>
                    @endif
                    <div class="quiz-container">
                        <h1>Quiz Game Results</h1>
                        <div class="player-container">
                            <h2>You</h2>
                            <p>Score: <span id="me-score">{{$user->game_score}}</span>/10</p>
                        </div>
                        <div class="player-container">
                            @if($challenger)
                            <h2>{{$challenger->name}}</h2>
                            <p>Score: <span id="other-score">{{$challenger->game_score}}</span>/10</p>
                            @endif
                        </div>

                        <form action="/game/done">
                            <button type="submit" class="btn btn-primary btn-block" >Finish game</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
