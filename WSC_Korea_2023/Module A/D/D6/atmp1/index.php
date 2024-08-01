<?php
session_start();
include_once 'db.php';

$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nickname = trim($_POST['nickname']);
	$stmt = $conn->prepare('SELECT * FROM users where nickname = ?');
	$stmt->bind_param('s', $nickname);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();

	if ($result->num_rows === 0 && $_POST['action'] === 'set_name') {
		$stmt = $conn->prepare('INSERT INTO users (nickname) VALUES (?)');
		$stmt->bind_param('s', $nickname);
		$stmt->execute();
		$stmt->close();

		$_SESSION['nickname'] = $nickname;
	}

	if ($_POST['action'] === 'remove_name') {
		$stmt = $conn->prepare('DELETE FROM users WHERE nickname = ?');
		$stmt->bind_param('s', $nickname);
		$stmt->execute();
		$stmt->close();
		$nickname = null;

		session_reset();

		$_SESSION['nickname'] = $nickname;
	}
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Speed Test</title>
		<link
			rel="stylesheet"
			href="./assets/bootstrap.min.css"
		/>
	</head>
	<body class="vw-100 vh-100">
		<main class="w-100 h-100 d-flex">

			<div class="modal fade" id="nameModal">
				<div class="modal-dialog modal-dialog-centered modal-sm">
					<div class="modal-content">
						<form method="POST" onsubmit="checkDuplicate(event)" class="p-4 d-flex flex-column">
							<input
								type="hidden"
								name="action"
								value="set_name"
							/>
							<label for="nickname" class="form-label"
								>Set nickname</label
							>
							<input
								type="text"
								name="nickname"
								class="form-control mt-2 mb-3"
								id="set-nickname-input"
							/>
							<button type="submit" class="btn btn-primary">
								submit
							</button>
						</form>

						<div class="modal-footer">
							<button
								type="button"
								class="btn btn-secondary"
								data-bs-dismiss="modal"
							>
								Close
							</button>
						</div>
					</div>
				</div>
			</div>

			<div
				class="w-25 border-end border-dark d-flex flex-column align-items-center join-chat"
			>
				<?php if (!isset($nickname)) :?>
					<button
						type="button"
						class="btn btn-light m-3 fs-4"
						data-bs-toggle="modal"
						data-bs-target="#nameModal"
					>
						Join Chat
					</button>

				<?php else : ?>
					<form method="POST">
						<input type="hidden" name="action" value="remove_name">
						<input type="hidden" name="nickname" value="<?php echo $nickname; ?>">
						<button type="submit" class="btn btn-light m-3 fs-4">Leave Chat</button>
					</form>

					<div class="fs-1"><?php echo htmlspecialchars($nickname); ?></div>

					<div class="fs-3 mt-5">Current Users</div>

					<div class="current-users"></div>

				<?php endif; ?>

			</div>

			<div class="w-75">
				<?php if (isset($nickname)) :?>

					<div style="height: 95%; overflow-y: scroll;" class="chat-wrapper">
						<div class="px-4 pt-3 w-100 chat-container"></div>
					</div>
					<div class="container-fluid">
						<form onsubmit="sendChat(event)" method="POST" class="d-flex">
							<input id="send-message" class="form-control" type="text" name='message' placeholder="Enter Message">
							<button type="submit" class="btn btn-light">Send</button>
						</form>
					</div>
				<?php endif; ?>
			</div>
		</main>
		<script src="./assets/bootstrap.bundle.min.js"></script>

		<script>
			const checkDuplicate = (e) => {
				e.preventDefault();
				const nicknameInput = document.getElementById('set-nickname-input').value.trim();

				fetch('./getusers.php', {
					method: 'GET'
				})
				.then(response => response.json())
				.then((data) => {
					if (data.includes(nicknameInput)) {
						alert('This username already exists, please choose a different one');
					} else {
						e.target.submit();
					}
				});
			}

			const con = document.querySelector('.chat-container');

			const getChats = () => {
				let nickname = "<?php echo $nickname; ?>";
				if (!nickname || nickname === '') return;

				fetch('./getchats.php', {
					method: 'GET'
				})
				.then(response => response.json())
				.then((data) => {
					con.innerHTML = ''

					data.forEach(chatMessage => {
						const wrapper = document.createElement('div');
						wrapper.classList.add('my-3');
						if (nickname == chatMessage.nickname) wrapper.classList.add('text-end');
						
						const auth = document.createElement('div');
						auth.classList.add('fs-3');
						auth.innerText = chatMessage.nickname;
						
						const mess = document.createElement('div');
						mess.classList.add('text-wrap', 'fs-5');
						mess.innerText = chatMessage.message;

						wrapper.appendChild(auth);
						wrapper.appendChild(mess);

						con.appendChild(wrapper);
					});
				})
			}

			const curUsers = document.querySelector('.current-users');
			
			const getUsers = () => {
				fetch('./getusers.php', {
					method: 'GET'
				})
				.then(response => response.json())
				.then((data) => {
					if (typeof curUsers != 'undefined' && curUsers != undefined && curUsers != null) {
						curUsers.innerHTML = '';
						data.forEach(nickname => {
							const nicknameElement = document.createElement('div');
							nicknameElement.textContent = nickname;
							nicknameElement.classList.add('fs-4', 'my-2');
							curUsers.appendChild(nicknameElement);
						})
					}
				})
			}

			const messageIn = document.getElementById('send-message');

			const sendChat = (e) => {
				e.preventDefault();

				message = messageIn.value.trim();

				if (!message) {
					alert('Message must contain content');
					return;
				}

				messageIn.value = '';

				const formData = new FormData();
				formData.append('message', message);

				fetch('./sendchat.php', {
					method: 'POST',
					body: formData,
				})

				getChats();
			}

			getUsers();
			getChats();

			setInterval(getChats, 4000);
			setInterval(getUsers, 3000);
		</script>
	</body>
</html>
