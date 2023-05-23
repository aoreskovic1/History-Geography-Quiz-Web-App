<script>

    function hideQuestion() {
        document.getElementById("question").style.display = "none";
        document.getElementById("answer-submitted").style.display = "block";
    }

    function displayQuestion() {
        document.getElementById("question").style.display = "block";
        document.getElementById("answer-submitted").style.display = "none";
    }

    let token = "{{Auth::user()->remember_token}}";
    let myID = "{{Auth::user()->id}}";

    let answerA = null;
    let answerB = null;
    let answerC = null;
    let answerD = null;

    getQuestion()

    function getQuestion() {
        $.ajax({
            url: "/api/me/question",
            method: "GET",
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(data) {

                try{
                    if(data.game.finished) {
                        window.location.href = "/game/finish";
                    }
                }
                catch(e) {}
                // Check if there is any data
                console.log("displaying question!")
                document.getElementById("question-title").innerHTML = data.question.title;
                document.getElementById("answerA").innerHTML = data.answers[0].title;
                document.getElementById("answerB").innerHTML = data.answers[1].title;
                document.getElementById("answerC").innerHTML = data.answers[2].title;
                document.getElementById("answerD").innerHTML = data.answers[3].title;

                answerA = data.answers[0].id;
                answerB = data.answers[1].id;
                answerC = data.answers[2].id;
                answerD = data.answers[3].id;
                displayQuestion();
            },
            error: function() {
                // Handle any errors here
                console.log("Checking for incoming question.")
                hideQuestion();
            },
            complete: function() {
                // If modal is not open, start checking for challenges again
                setTimeout(getQuestion, 2000);
            }
        });
    }

    function answerQuestion(answer) {

        let answerID;

        switch(answer) {
            case 'A':
                answerID = answerA;
                break;
            case 'B':
                answerID = answerB;
                break;
            case 'C':
                answerID = answerC;
                break;
            case 'D':
                answerID = answerD;
                break;
        }

        $.ajax({
            url: "/api/game/answer/"+answerID,
            method: "POST",
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(data) {
                // Check if there is any data
                console.log("Answering question!")
                if(data.correct) {
                    alert("Correct! Great work!")
                }
                else alert("You are wrong. :(")
            },
            error: function() {
                // Handle any errors here
                console.log("Error answering question.")
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

    document.addEventListener('DOMContentLoaded', function() {
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
    });



</script>
