<?php

session_start();
include_once './db.php';

$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : null;
$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (!isset($nickname) && $_POST['action'] == 'set-name') {
        $trimed_name = trim($_POST['nickname']);
        $stmt = $conn->prepare('INSERT INTO users (nickname) VALUES (?)');
        $stmt->bind_param('s', $trimed_name);
        $stmt->execute();
        $stmt->close();

        $nickname = $trimed_name;
        $_SESSION['nickname'] = $nickname;

        $stmt = $conn->prepare('SELECT id FROM users WHERE nickname = (?)');
        $stmt->bind_param('s', $nickname);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $id = $result->fetch_assoc()['id'];
        $_SESSION['id'] = $id;
    }
    
    if (isset($nickname) && $_POST['action'] == 'delete-name') {
        $stmt = $conn->prepare('DELETE FROM users WHERE id = (?)');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();

        $nickname = null;
        $_SESSION['nickname'] = $nickname;

        $id = null;
        $_SESSION['id'] = $id;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Chat</title>
    <link rel="stylesheet" href="./assets/bootstrap.min.css">
</head>
<body>
    <main class="d-flex vw-100 vh-100">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">    
                    <div class="modal-body">
                        <form method="POST">
                            <div class="mb-3">
                                <input type="hidden" name="action" value='set-name'>
                                <label for="nickname" class="form-label">Nickname</label>
                                <input type="text" class="form-control" required id="nickname" name="nickname" aria-describedby="nickname">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="w-25 h-100 border-end border-2 border-black d-flex flex-column align-items-center">
            <?php if(!isset($nickname)) : ?>
                <button type="button" class="btn btn-light my-3 fs-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Join Chat
                </button>
                <?php else : ?>
                <form method="POST">
                    <input type="hidden" name="action" value="delete-name">    
                    <button type="submit" class="btn btn-light my-3 fs-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Leave Chat
                    </button>
                </form>

                <div class="fs-2"><?php echo $nickname; ?></div>

                <div class="mt-4 fs-3">Current Users</div>

                <div class="user-container"></div>
                
            <?php endif; ?>
        </div>

        <div class="w-75">
        <?php if(isset($nickname)) : ?>
            
            <div class="chat-container m-3" style="height: 90%; overflow-y: scroll;">

            </div>

            <form onsubmit="sendChat(event)" class="d-flex">
                <input class="form-control w-75 mx-2" type="text" name="message" id="message-input" placeholder="Enter Message">
                <button type="submit" class="btn btn-light">
                        Send Message
                </button> 
            </form>

        <?php endif; ?>
        </div>


    </main>
    <script src="./assets/bootstrap.bundle.min.js"></script>

    <script>
        const userContainer = document.querySelector('.user-container');

        const getUsers = () => {
            fetch('./getusers.php', {
                method: 'GET'
            })
            .then(request => request.json())
            .then(data => {
                userContainer.innerHTML = '';
                data.forEach(user => {
                    const userElement = document.createElement('div');
                    userElement.innerText = user;

                    userContainer.appendChild(userElement);
                });
            })
        }

        const chatContainer = document.querySelector('.chat-container');

        const getChats = () => {
            fetch('./getchats.php', {
                method: 'GET'
            })
            .then(request => request.json())
            .then(data => {
                chatContainer.innerHTML = '';
                data.forEach(chat => {
                    const chatElement = document.createElement('div');
                    if (chat.nickname === '<?php echo isset($nickname) ? $nickname : 'default'; ?>') {
                        chatElement.classList.add('text-end');
                    }

                    const nicknameElement = document.createElement('div');
                    nicknameElement.classList.add('fs-3');
                    nicknameElement.innerText = chat.nickname;
                    const messageElement = document.createElement('p');
                    messageElement.innerText = chat.message;

                    chatElement.appendChild(nicknameElement);
                    chatElement.appendChild(messageElement);
                    chatContainer.appendChild(chatElement);
                });
            })
        }

        const messageInput = document.getElementById('message-input');

        const sendChat = (e) => {
            e.preventDefault();
            let input = messageInput.value;

            if (!input) {
                alert('Message must have content');
                return;
            }

            const formData = new FormData();
            formData.append('message', input);

            fetch('./sendchat.php', {
                method: 'POST',
                body: formData,
            })

            messageInput.value = '';
            getChats();
        }

        if (chatContainer) {
            getChats()
            setInterval(getChats, 6000);
        }

        if (userContainer) {
            getUsers()
            setInterval(getUsers, 3000);
        }

    </script>
</body>
</html>