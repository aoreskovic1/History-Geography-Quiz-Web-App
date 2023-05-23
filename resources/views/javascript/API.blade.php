<script>
    let token = "{{Auth::user()->remember_token}}";
    let myID = "{{Auth::user()->id}}";

    let modalOpen = false;
    let challenger = null;

    function checkForChallenges() {
        $.ajax({
            url: "/api/me/challenges",
            method: "GET",
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(data) {
                // Check if there is any data
                console.log("displaying modal!")

                if(data.challenger.user_id == myID) {
                    window.location.href = "/game/";
                }

                if (!modalOpen) {
                    // Open bootstrap modal
                    let modal = document.querySelector('#myModal');
                    document.getElementById('challenger').innerHTML = data.challenger.name;
                    modal.classList.add('show');
                    modal.style.display = 'block';
                    challenger = data.challenger.id;
                    modalOpen = true;
                }
            },
            error: function() {
                // Handle any errors here
                console.log("Checking for incoming challenges.")
            },
            complete: function() {
                // If modal is not open, start checking for challenges again
                if (!modalOpen) {
                    setTimeout(checkForChallenges, 2000);
                }
            }
        });
    }

    function denyChallenge() {
        $.ajax({
            url: "/api/me/challenges/deny",
            method: "POST",
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(data) {
                // Check if there is any data
                console.log("Challenge denied!")
            },
            error: function() {
                // Handle any errors here
                console.log("Error denying challenge.")
            }
        });
    }

    function challengeUser(id) {
        $.ajax({
            url: "/api/challenge/"+id,
            method: "POST",
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(data) {
                // Check if there is any data
                console.log("Challenging user "+id+"!")
                challenger = id;
            },
            error: function() {
                // Handle any errors here
                console.log("Error denying challenge.")
            }
        });
    }

    function sendMessage(message) {
        $.ajax({
            url: "/api/message/send",
            method: "POST",
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + token
            },
            data: {
                message: message,
            },
            success: function(data) {
                // Check if there is any data
                console.log("Message sent!")

                let messageElement = $('<div id='+data.id+' class="message">' +
                    '<div class="message-text"><strong>You:</strong> ' + data.message + '</div>' +
                    '<small class="message-time">' + data.created_at.slice(0,-8).replace('T', ' ') + '</small>' +
                    '<hr>' +
                    '</div>');

                // Prepend the new message to the message list
                $('#message-list').prepend(messageElement);
            },
            error: function() {
                // Handle any errors here
                console.log("Error sending message.")
            }
        });
    }

    function getMessages() {
        $.ajax({
            url: "/api/messages/get",
            method: "GET",
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(data) {
                // Loop through each message in the data array
                $.each(data, function(index, message) {
                        // Check if the message ID already exists in the DOM
                        if (!$('#' + message.id).length) {
                            // If the message doesn't exist, create a new message element and append it to the message list
                            var messageElement = $('<div id="' + message.id + '" class="message">' +
                                '<div class="message-text"><strong>'+message.author.name+'</strong> ' + message.message + '</div>' +
                                '<small class="message-time">' + message.created_at.slice(0,-8).replace('T', ' ') + '</small>' +
                                '<hr>' +
                                '</div>');
                            $('#message-list').prepend(messageElement);
                        }
                    });
            },
            error: function() {
                console.log("Error receiving messages.")
            },
            complete: function() {
                setTimeout(getMessages, 2000);
            }
        });
    }

    getMessages();

    // Start checking for challenges
    checkForChallenges();

    // When modal is closed, start checking for challenges again
    $('#myModal').on('hidden.bs.modal', function() {
        modalOpen = false;
        checkForChallenges();
    });

    // Get the modal and buttons
    let modal = document.getElementById('myModal');
    let acceptButton = document.getElementById('acceptButton');
    let denyButton = document.getElementById('denyButton');
    let closeButton = document.getElementById('closeButton');


    // Add event listeners to the buttons
    let msgButton = document.getElementById('messageButton');
    msgButton.addEventListener('click', function() {
        console.log('Sending message!');

        // Get the input field element and its value
        var input = document.getElementById('message-input');
        var message = input.value;

        // Send the message
        sendMessage(message);

        // Clear the input field
        input.value = '';
    });

    // Add event listeners to the buttons
    acceptButton.addEventListener('click', function() {
        // Handle accepting the challenge here
        console.log('Challenge accepted!');
        challengeUser(challenger);
        // Hide the modal
        modal.style.display = 'none';
        window.location.href = "/game/";
    });

    denyButton.addEventListener('click', function() {
        modal.style.display = 'none';
        modalOpen = false;
        denyChallenge();
        checkForChallenges();
    });

    closeButton.addEventListener('click', function() {
        // Handle denying the challenge here
        // Hide the modal
        modal.style.display = 'none';
        modalOpen = false;
    });
</script>
