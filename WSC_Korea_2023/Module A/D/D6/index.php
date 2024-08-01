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
						<form method="POST" class="p-4 d-flex flex-column">
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
				<?php 
					// $stmt = $conn->prepare('SELECT nickname FROM users WHERE nickname != ?');
					// $stmt->bind_param('s', $nickname);
					// $stmt->execute();
					// $result = $stmt->get_result();
					// $stmt->close();

					// while($row = $result->fetch_assoc()) :
				?>
						<!-- <div><?php // echo $row['nickname']; ?></div> -->
				<?php
					// endwhile;
				?>

			<?php endif; ?>

			</div>

			<div class="w-75">
				<div style="height: 95%; overflow-y: scroll;">
					<div class="px-4 pt-3 w-100 chat-container">
						<div class="my-3">
							<div class="fs-3">Author</div>
							<div class="text-wrap fs-5">Content of message is here</div>
						</div>
						<div class="text-end my-3">
							<div class="fs-3">Author</div>
							<div class="text-wrap fs-5">Content of message is here</div>
						</div>
					</div>
	
				</div>
				<div class="container-fluid">
					<form action="POST" onsubmit="addChat(event)" class="d-flex">
						<input id="send-message" class="form-control" type="text" name='message' placeholder="Enter Message">
						<button type="submit" class="btn btn-light">Send</button>
					</form>
				</div>
			</div>
		</main>
		<script src="./assets/bootstrap.bundle.min.js"></script>

		<script>
			const con = document.querySelector('.chat-container');

			const curUsers = document.querySelector('.current-users');
			
			const getUsers = () => {
				fetch('./getUsers.php', {
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

			getUsers();

			setInterval(getUsers, 3000);
		</script>
	</body>
</html>
