<?php

use app\components\Helper;

?>

<style>
    .chat-container {
        display: flex;
        height: calc(100vh - 100px);
        gap: 20px;
        padding: 0px 10px;
    }

    .users-sidebar {
        width: 250px;
        background: #f5f5f5;
        border-right: 1px solid #ddd;
        padding: 20px;
        overflow-y: auto;
    }

    .chat-screen {
        flex: 1;
        display: flex;
        flex-direction: column;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .chat-messages {
        flex: 1;
        overflow-y: auto;
        margin-bottom: 20px;
        padding: 10px;
        background: #fff;
        display: flex;
        flex-direction: column;
        gap: 10px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .message-input {
        display: flex;
        gap: 10px;
        align-items: center;
        padding: 5px;
    }

    .message-input input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        border: none;
        outline: none;
    }

    .message-input button {
        padding: 10px 20px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .user-item {
        padding: 10px;
        margin-bottom: 5px;
        background: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .user-item:hover {
        background: #e9ecef;
    }

    .message {
        background-color: #fafafa;
        padding: 10px;
        border-radius: 5px;
        width: 80%;
        margin: auto 0px 0px auto;
    }

    .message-black {
        background-color: rgb(37, 37, 37);
        color: #fefefe;
        margin: 0px auto auto 0px;
    }
</style>

<div class="chat-container">
    <!-- Left Sidebar for Users -->
    <div class="users-sidebar">
        <h4 style="font-size: 1.0rem;">Peoples</h4>
        <div class="users-list">
            <?php
            foreach ($peoples as $people): ?>
                <a href="<?php echo Helper::baseUrl("/peoples/chat?other={$people['id']}") ?>">
                    <div class='user-item'>
                        <?= $people['username']; ?>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Right Chat Screen -->
    <div class="chat-screen">
        <div class="" style="background-color:#fafafa;padding:10px;display:flex;justify-content:space-between;">
            <h4 style="font-size:1.0rem;"><?= $other->username; ?></h4>
            <button type="button" id="soundButton" style="border:none;"><i class="fa fa-volume-high"></i></button>
        </div>
        <div class="chat-messages">
            <!-- Messages will be displayed here -->
            <?php

            // foreach ($messages as $msg) {
            //     $otherMessage = $msg->sender_id == Yii::$app->request->get('other') ? 'message-black' : '';
            //     echo "<div class='message {$otherMessage}'>
            //     <p><strong>{$msg->sender->username}:</strong> <small><em>{$msg->created_at}</em></small></p>  
            //     <p>{$msg->message}</p>
            //     </div>";
            // }
            ?>
        </div>
        <form class="message-input" id="messageForm">
            <input type="text" id="messageText" placeholder="Type your message...">
            <button type="submit">Send</button>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

<script>
    const secretkeyForEncryption = "random1000secret1000keys";
    // Function to encrypt text
    function encryptText(text, secretKey) {
        return CryptoJS.AES.encrypt(text, secretKey).toString();
    }

    // Function to decrypt text
    function decryptText(encryptedText, secretKey) {
        let bytes = CryptoJS.AES.decrypt(encryptedText, secretKey);
        return bytes.toString(CryptoJS.enc.Utf8);
    }

    function toggleSound(soundButton) {
        const isSoundOn = sessionStorage.getItem("messageSound") === "true";

        if (isSoundOn) {
            soundButton.innerHTML = `<i class="fas fa-volume-high"></i>`;
            soundButton.classList.remove("sound-off");
        } else {
            soundButton.innerHTML = `<i class="fas fa-volume-xmark"></i>`;
            soundButton.classList.add("sound-off");
        }
    }

    const soundButton = document.querySelector("#soundButton");

    if (!sessionStorage.getItem("messageSound")) {
        sessionStorage.setItem("messageSound", "true");
    }

    if (soundButton) {
        toggleSound(soundButton);

        soundButton.addEventListener("click", () => {
            const currentState = sessionStorage.getItem("messageSound") === "true";
            sessionStorage.setItem("messageSound", !currentState);
            toggleSound(soundButton);
        });
    }

    const baseUrl = "<?php echo Helper::baseUrl("") ?>";
    const myId = "<?php echo Yii::$app->user->identity->id; ?>";
    const myName = "<?php echo Yii::$app->user->identity->username; ?>";
    const otherId = "<?php echo Yii::$app->request->get('other'); ?>";

    function SSE_EVENT(params) {
        // Connect to the SSE endpoint
        const eventSource = new EventSource(`${baseUrl}sse/chat?myId=${myId}&otherId=${otherId}`); // Replace with actual IDs
        eventSource.onmessage = function(event) {
            console.log(event)
            const data = JSON.parse(event.data);
            console.log(data)
            addMessage(data);
        };

        eventSource.onerror = function(event) {
            // console.error("Error occurred:", event);
        };
    }
    SSE_EVENT();

    function addMessage(data) {
        const messagesDiv = document.querySelector('.chat-messages');
        // Inside your EventSource event listener
        messagesDiv.insertAdjacentHTML('beforeend', `<div class="message ${data.sender_id == otherId?"message-black":""}"><p><strong>${data.sender}:</strong> <small><em>${data.created_at}</em></small></p>  
                <p>${decryptText(data.message,secretkeyForEncryption)}</p>
                </div>`);
        // Scroll to the bottom
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
        if (sessionStorage.getItem("messageSound") == "true" && data.sender_id == otherId) {
            const messageSound = new Audio(`${baseUrl}assets/audios/notification.mp3`);
            messageSound.play();
        }
    }

    const sendMessage = async (senderId, receiverId, message, job_post_id) => {
        const response = await fetch(`${baseUrl}api/add-message`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                job_post_id: job_post_id,
                sender_id: senderId,
                receiver_id: receiverId,
                message: message,
            }),
        });

        const result = await response.json();
        if (result.success) {
            console.log('Message sent:', result.data);
        } else {
            console.error('Error:', result.message, result.errors);
        }
    };

    function showMessages() {
        fetch(`${baseUrl}api/messages?other=${otherId}`)
            .then(r => r.json())
            .then(d => {
                // console.log(d)
                const messages = d.messages;
                const messagesDiv = document.querySelector('.chat-messages');
                messages.map(data => {
                    // Inside your EventSource event listener
                    messagesDiv.insertAdjacentHTML('beforeend', `<div class="message ${data.message.sender_id == otherId?"message-black":""}"><p><strong>${data.sender.username}:</strong> <small><em>${data.message.created_at}</em></small></p>  
                <p>${decryptText(data.message.message,secretkeyForEncryption)}</p>
                </div>`);
                    // Scroll to the bottom
                    messagesDiv.scrollTop = messagesDiv.scrollHeight;
                });
            })
    }
    showMessages();

    function getFormatedTime() {
        const currentDate = new Date();

        // Format the date components
        const year = currentDate.getFullYear();
        const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so add 1
        const day = String(currentDate.getDate()).padStart(2, '0');

        // Format the time components
        const hours = String(currentDate.getHours()).padStart(2, '0');
        const minutes = String(currentDate.getMinutes()).padStart(2, '0');
        const seconds = String(currentDate.getSeconds()).padStart(2, '0');

        // Combine into the desired format
        const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        return formattedDateTime;
    }

    const postID = "<?php echo Yii::$app->request->get("post"); ?>";
    if (parseInt(postID) > 0) {
        const postTitle = "I am intered for : <?php echo $post->title ?? ""; ?>"
        const encText = encryptText(postTitle, secretkeyForEncryption);
        const data = {
            job_post_id: postID,
            sender_id: myId,
            sender: myName,
            created_at: getFormatedTime(),
            message: encText,
        };
        // addMessage(data);
        sendMessage(myId, otherId, encText, job_post_id = postID);
        removeURLParameter('post');
    }

    function removeURLParameter(parameter) {
        let url = new URL(window.location.href);
        url.searchParams.delete(parameter);
        window.history.replaceState(null, null, url.toString());
    }

    const messagForm = document.querySelector("#messageForm");
    if (messagForm) {
        messagForm.addEventListener("submit", (event) => {
            event.preventDefault();
            const messageInput = document.querySelector("#messageText");
            if (messageInput.value.length > 0) {
                const encText = encryptText(messageInput.value, secretkeyForEncryption);
                const data = {
                    job_post_id: null,
                    sender_id: myId,
                    sender: myName,
                    created_at: getFormatedTime(),
                    message: encText,
                };
                addMessage(data);
                sendMessage(myId, otherId, encText, job_post_id = 0);
                messagForm.reset();
            }
        })
    }
</script>