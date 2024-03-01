<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:ital,wght@1,700&family=Berkshire+Swash&family=Cardo&family=Cinzel+Decorative:wght@700&family=Handjet:wght@300&family=Handlee&family=Lato&family=Lilita+One&family=Lobster&family=Lora:ital,wght@1,500&family=Lugrasimo&family=Merienda:wght@700&family=Monoton&family=Nunito&family=Oswald:wght@700&family=Poppins&family=Roboto:wght@300&family=Shrikhand&family=Special+Elite&family=VT323&family=Victor+Mono:wght@100&family=Yatra+One&display=swap');


*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  html{
    height: 100%;
    width: 100%;
    scroll-behavior: smooth;
    position: relative;
  }
body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: white;
  background-color: #383838;
  overflow-x: hidden;
}

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  html{
    height: 100%;
    width: 100%;
    scroll-behavior: smooth;
    position: relative;
  }

.chat-container {
    margin-left: 30px;
  margin-bottom: 10px;
  width: 100%;
    position: fixed;
    bottom: 0;
    overflow: hidden;
  justify-content: center;
  align-items: center;
  font-size: 1rem;
  line-height: 1.5rem;
  
}

.chat-messages {
    height: 532px;
    overflow-y: scroll;
    padding: 10px;
  
}

.chat-input {
    width: calc(100% - 150px);
    padding: 10px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    background-color: transparent;
  border-radius: 15px;
  font-family: victor mono;
  font-weight: 700;
}

.send-button {
  background-color: transparent;


    border: none;
    cursor: pointer;
    margin-left: 6px;
}

.chat-message {
    margin-bottom: 10px;
    padding: 5px;
    border-radius: 5px;
    background-color: #000000;
  color: wheat;
}

    </style>
</head>
<body>

        <div class="chat-messages" id="chat-messages">
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
        echo $result['choices'][0]['message']['content']; }?>
        </div>
        <form action="" method="post">
        <div style="display: flex;">
        <h3>Some changes in form </h3>
            <input type="text" class="chat-input" id="user-input" placeholder="Type your message..." onkeypress="handleKeyPress(event)" name="request">
            <button class="send-button" ><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAADAklEQVR4nO2ZOWgVURSGbzSS4BIR8tyChVEQREWwUbQRlWCnhSAIWqmISFoLQbEKEo2onWAhSEBBxK1UESxcGmOiIKiFO7hLNOLyySH/I9fJm/dm5i2Zkfc1ydw598z5OWfO3Hufc3Xq1PkvAFqATuAxcMNlDWABcBz4wgiPXBYAGoC1wFngF6PpdGkGmALsAAYIxzIz1aURYB7QBXzwAn4JnABeBIQccyksnw7gCvDbC/QasAGYCfRp7Ln+/rF3xqUBYLLKp98Lfgg4DSyRTc4T8RDo1v9Xxzp+C65d5fPeE/AKOAC0ena5gIg24Kmu14+lgFUFus89YCvQGLDNBURYeW3UtX0/xtU6+GYF+iBQPiZoecicUSI0fl1je8a6fF6rfHJF5oWJWKQX3FpuSy3L52eB8plQYm5BEQZwUuNHXQ3KJx+E8UOCVkT0UUzENGCwai0XmK1SeecJeKOSaovhJ1SEAezVvcuuRuVj34TmmL5KiRgPPNP9jkoE36TyuV+gfFYm9FlUhAFsqkjLDSmftyqfOWX4LSnCAG7KZrdLihZq/sfrrrLSlNjpaBF9Ye0YWCqbT7YaLueB+eUAKqmF5QiII8IATsmux5WDlgU9wDc5tJVpb1JBMUXkgO965vyyhAScdqmX5wVdstRX+p3w7PfJ9mJFRFRCUAIRjd6+Y13FhSQRFFeE5mz27BuqJiSqoCQiNO+W5uyquojAg2cAhwOCeqO+2AFfyzTno+0gqx994SBa9fH87LXtyJmQD9vmGt3VjTZaMNOBcwqoN2Zmh5TRdpcGlJ2vCmpxxDn7Jf6CSxPeiUfJrNimyzu3WuPShEplMEpWgC0SMVCTlhsXdbOSWQFuy26nSyNEyIqdpngtd5JLK5TICnBG9w+5NEORrACztNO0fc9cl3aAI4WyAhzU+HmXBRje2/yTFZ0D2KmLsdplBQJZAbbpuj+VLTdqVoA7ErLdZQ2Gt854x0p2NjzRZQ1GspKny2UVRrKSjZZbIitP7DfzUKM6deq4avEXfFisjrL4iOMAAAAASUVORK5CYII="></button>
        </div>
        </form>
    </div>
    </body>
    </html>
    