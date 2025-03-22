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
        line-height: 10px;
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
    .no-chat{
        padding: 40px;
        text-align: center;
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
            <h4 style="font-size:1.0rem;"><?= Yii::$app->user->identity->username; ?></h4>
            <!-- <button type="button" id="soundButton" style="border:none;"><i class="fa fa-volume-high"></i></button> -->
        </div>
        <div class="chat-messages">

            <div class="no-chat">
                <p>Start Chat</p>
                <h4>Select people to start chat</h4>
            </div>

        </div>
    </div>
</div>