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
                    <h1 class='h2 mb-2'>You're playing against {{$name}}</h1>

                    <a href="{{route('gameDone')}}"><button class="btn bg-danger mb-5 text-white">Leave game</button></a>


                    <div class="container">
                        <div class="row justify-content-center">
                          <div id="question" class="col-md-8">
                            <div class="question mb-4 mb-md-5">
                              <h4 class="mb-4">Question</h4>
                              <p id='question-title'>What is the capital of France?</p>
                            </div>
                            <div class="row">
                              <div class="col-6 col-md-3 mb-3 mb-md-0">
                                <button id='A' type="button" class="btn btn-primary btn-block" onclick="answerQuestion('A')">A. <span id="answerA">Paris</span></button>
                              </div>
                              <div class="col-6 col-md-3 mb-3 mb-md-0">
                                <button id='B' type="button" class="btn btn-primary btn-block" onclick="answerQuestion('B')">B. <span id="answerB">London</span></button>
                              </div>
                              <div class="col-6 col-md-3 mb-3 mb-md-0">
                                <button id='C' type="button" class="btn btn-primary btn-block" onclick="answerQuestion('C')">C. <span id="answerC">Madrid</span></button>
                              </div>
                              <div class="col-6 col-md-3 mb-3 mb-md-0">
                                <button id='D' type="button" class="btn btn-primary btn-block" onclick="answerQuestion('D')">D. <span id="answerD">Berlin</span></button>
                              </div>
                            </div>
                          </div>
                          <div class="text-center" id="answer-submitted" style="display: none;">
                            <h4>Waiting for the other player to answer...</h4>
                          </div>
                        </div>
                      </div>


                      @include('javascript.game-api')
                </div>
            </div>
        </div>
    </div>


    <div class="m-5">
        <div class="">
          <div class="card w-75">
            <div class="card-body">
              <div id='message-list' class="message-list overflow-auto" style="max-height: 200px;">


            </div>
              <div>
                <div class="input-group">
                  <input id='message-input' name='message' type="text" class="form-control" placeholder="Type a message">
                  <div class="input-group-append">
                    <button id='messageButton' class="btn bg-primary m-2 text-white">Send</button>
                  </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>

</div>
