<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emoji Guessing Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq784/q6eTqOMdAyjWxz3hoLsxtR+pr4a4+06rJTa+76PVCmYl+ngiu" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" rel="stylesheet"/>

    <style>
        body {
            background-color: #fafafa;
        }

        .container {
            width: 50%;
            margin: auto;
        }

        .emoji-guess {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .emoji {
            font-size: 100px;
        }

        .chat {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
        }

        .chat li span {
            font-size: 16px;
        }

        .chat li i {
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Emoji Guessing Game</h1>
        <div class="row">
            <div class="col-sm-6">
                <h2>Player 1</h2>
                <input type="text" class="form-control" placeholder="Choose your emoji">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
            <div class="col-sm-6">
                <h2>Player 2</h2>
                <div class="emoji-guess">
                    <span></span>
                </div>
                <div class="chat">
                    <ul class="list-unstyled">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(function() {
    // Get the submit buttons
    const submitButtons = $('.btn-primary');

    // When a player submits their emoji
    submitButtons.on('submit', function(event) {
        // Prevent the form from submitting
        event.preventDefault();

        // Get the emoji that was submitted
        const emoji = $(this).val();

        // Update the emoji guess
        $('.emoji-guess span').text(emoji);

        // Send the emoji to the other player
        $.get('multiplayer.php', { emoji: emoji });
    });

    // Handle the emoji guess
    $(document).on('ajaxComplete', function(event, xhr, settings) {
        // Get the emoji guess from the server
        const emoji = xhr.responseText;

        // Update the chat
        $('.chat ul').append(`<li><i class="fas fa-emoji"></i> ${emoji}</li>`);

        // Check if there is a second player
        $.get('multiplayer.php', function(data) {
            if (data.status === 'ok') {
                // There is a second player
                $('.second-player').show();
            } else {
                // There is no second player
                $('.second-player').hide();
            }
        });
    });

    // Switch theme
    const themeButton = $('.theme-button');
    themeButton.on('click', function() {
        const currentTheme = $('body').css('color');
        if (currentTheme === '#ffffff') {
            $('body').css('color', '#000');
            themeButton.text('Switch to White Theme');
        } else {
            $('body').css('color', '#ffffff');
            themeButton.text('Switch to Black Theme');
        }
    });

    // Get the emoji from the user
    const emojiInput = $('.emoji-input');
    emojiInput.on('change', function() {
        const emoji = $(this).val();
        $('.emoji-guess span').text(emoji);
    });
});
    </script>
</body>
</html>
