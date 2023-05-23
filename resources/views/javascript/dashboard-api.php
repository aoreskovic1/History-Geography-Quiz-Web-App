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
