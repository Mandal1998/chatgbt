<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT</title>
    <style>
        .chat-container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .chat-message {
            margin-bottom: 10px;
        }
        .user-message {
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
        }
        .ai-message {
            background-color: #d9edf7;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="chat-container">
    <?php
    if(isset($_POST['request'])){
        $ch = curl_init();
        $request = $_POST['request'];
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $postdata = array(
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "user",
                    "content" => "$request"
                ]
            ],
            "temperature" => 1,
            "max_tokens" => 256,
            "top_p" => 1,
            "frequency_penalty" => 0,
            "presence_penalty" => 0
        );
        $postdata= json_encode($postdata);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer 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';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $result = json_decode($result,true);
        ?>
        <div class="chat-message user-message">
            <?php echo $result['choices'][0]['message']['content']; ?>
        </div>
        <div class="chat-message ai-message">
            <?php echo $_POST['request']; ?>
        </div>
        <?php
    }
    ?>
</div>

<div class="chat-container">
    <form action="" method="post">
        <input type="text" name="request" class="form-control" placeholder="Type your message..." required>
        <input type="submit" name="submit" class="form-control" value="Send">
    </form>
</div>

</body>
</html>
