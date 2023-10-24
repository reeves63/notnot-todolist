<?php
include 'database.php';

$q_select = "SELECT * FROM tasks WHERE taskid = '" . $_GET['id'] . "'";
$run_q_select = mysqli_query($conn, $q_select);
$d = mysqli_fetch_object($run_q_select);

if (isset($_POST['edit'])) {
    $new_task_label = $_POST['task'];
    $new_task_desc = $_POST['task_desc'];
    $new_task_deadline = date('Y-m-d H:i:s', strtotime($_POST['task_deadline']));

    $q_update = "UPDATE tasks SET tasklabel = '$new_task_label', task_desc = '$new_task_desc', task_deadline = '$new_task_deadline' WHERE taskid = '" . $_GET['id'] . "'";
    $run_q_update = mysqli_query($conn, $q_update);

    header('Refresh:0; url=index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>To Do List</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
		* {
			padding:0;
			margin:0;
			box-sizing: border-box;
		}
		body {
			font-family: 'Roboto', sans-serif;
			background: #fff;
		}
		.container {
			width: 590px;
			height: 100vh;
			margin:0 auto;
		}
		.header {
			padding: 15px;
		}
		.header .title {
			display: flex;
			align-items: center;
			margin-bottom: 7px;
		}
		.header .title i {
			font-size: 24px;
			margin-right: 10px;
		}
		.header .title span {
			font-size: 18px;
		}
		.header .description {
			font-size: 13px;
		}
		.content {
			padding: 15px;
		}
		.card {
			background-color: #fff;
			padding:15px;
			border-radius: 5px;
			margin-bottom: 10px;
		}
		.input-control {
			width:100%;
			display: block;
			padding:0.5rem;
			font-size: 1rem;
			margin-bottom: 10px;
		}
		.text-right {
			text-align: right;
		}
		button {
			padding:0.5rem 1rem;
			font-size: 1rem;
			cursor: pointer;
			background-color: #1b8da4;
			border:1px solid;
			border-radius: 3px;
			color: white;
		}
		.task-item {
			display: flex;
			justify-content: space-between;
		}
		.text-orange {
			color: orange;
		}
		.text-red {
			color: red;
		}
		.task-item.done span {
			text-decoration: line-through;
			color: #ccc;
		}

		@media (max-width: 768px){
			.container {
				width: 100%;
			}
		}
	</style>
</head>
<nav class="navbar navbar-light bg-light animate__animated animate__fadeIn">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="Notion_App_Logo.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
      <span class="fw-bold">NotNot</span>
      </style>
      <a class="nav-link fw-bold" href="logout.php">Log Out</a>
    </a>
  </div>
</nav>
<body>
    <div class="container">
        <div class="header">
            <div class="title">
                <a href="index.php"><i class='bx bx-chevron-left'></i></a>
                <span>Back</span>
            </div>
            <div class="description">
                <?= date("l, d M Y") ?>
            </div>
        </div>
        <div class="content">
            <div class="card">
                <form action="" method="post">
                    <input type="text" name="task" class="input-control" placeholder="Edit task" value="<?= $d->tasklabel ?>">
                    <textarea name="task_desc" class="input-control" placeholder="Edit task description"><?= $d->task_desc ?></textarea>
                    <input type="datetime-local" name="task_deadline" class="input-control" placeholder="Edit task deadline" value="<?= date('Y-m-d\TH:i', strtotime($d->task_deadline)) ?>">
                    <div class="text-right">
                        <button type="submit" name="edit">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>