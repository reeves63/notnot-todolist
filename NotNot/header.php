<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To Do List</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="Notion_App_Logo.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
            <span class="fw-bold">NotNot</span>
        </a>
        <div class="search-box">
            <button class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
            <input type="text" id="search" class="input-search" placeholder="Type to Search..." oninput="searchTasks()">
        </div>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    </div>
</nav>
<div class="container">
    <div class="header">
      <div class="title text-center">
        <i class='bx bx-sun'></i>
        <span>To Do List</span>
      </div>
      <div class="description text-center">
        <?= date("l, d M Y") ?>
      </div>
    </div>
    <div class="content">
      <div class="container mb-3">
        <form action="" method="post" onsubmit="return validateForm()">
          <input type="text" name="task" class="form-control mb-3 border-0" placeholder="Add Task">
          <textarea name="task_desc" class="form-control mb-3 border-0" placeholder="Add Task Description"></textarea>
          <input type="datetime-local" name="task_deadline" class="form-control mb-3 border-0" placeholder="Add Task Deadline">
          <div class="text-right">
            <button type="submit" name="add" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
    </nav>
  </body>
<html>