<!DOCTYPE html>
<html lang="en">
<head>
    <title>Chat GPT Laravel | Code with Ross</title>
    <link rel="icon" href="https://assets.edlin.app/favicon/favicon.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- End JavaScript -->

    <!-- CSS -->
    <link rel="stylesheet" href="/gpt-style.css">
    <!-- End CSS -->

</head>

<body>
<div class="chat">

    <!-- Header -->
    <div class="top">
        <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">
        <div>
            <p>Ross Edlin</p>
            <small>Online</small>
        </div>
    </div>
    <!-- End Header -->

    <!-- Chat -->
    <div class="messages">
        <div class="left message">
            <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">
            <p>Start chatting with Chat GPT AI below!!</p>
        </div>
    </div>
    <!-- End Chat -->

    <!-- Footer -->
    <div class="bottom">
        <form>
            <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
            <button type="submit"></button>
        </form>
    </div>
    <!-- End Footer -->

</div>
</body>

<script>
    $("form").submit(function (event) {
        event.preventDefault();

        const userMessage = $("form #message").val().trim();
        if (userMessage === '') return;

        $("form #message").prop('disabled', true);
        $("form button").prop('disabled', true);

        // Show user message
        $(".messages").append('<div class="right message">' +
            '<p>' + userMessage + '</p>' +
            '<img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">' +
            '</div>');

        // Show temporary typing animation
        $(".messages").append('<div class="left message typing-loader">' +
            '<img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">' +
            '<p><em>Typing...</em></p>' +
            '</div>');

        $(document).scrollTop($(document).height());

        $.ajax({
            url: "/chat",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            data: {
                "model": "mistral",
                "content": userMessage
            }
        }).done(function (res) {
            const messageText = res.content && res.content.length ? res.content[0].text : 'No response';

            // Remove typing animation
            $('.typing-loader').remove();

            // Show AI response
            $(".messages").append('<div class="left message">' +
                '<img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">' +
                '<p>' + messageText + '</p>' +
                '</div>');

            $("form #message").val('');
            $(document).scrollTop($(document).height());

            $("form #message").prop('disabled', false);
            $("form button").prop('disabled', false);
        });
    });

</script>
</html>
