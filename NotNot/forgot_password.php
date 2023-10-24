<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<style>
  .container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }
  h1 {
    text-align: center;
  }

  .btn-primary {
            background-color: #1b8da4;
            border: none;
            padding: 10px 20px;
            color: #fff;
            border-radius: 3px;
            cursor: pointer;
        }
  .btn-primary:hover {
            background-color: #2980b9;
        }
</style>
</head>
<body>
<nav class="navbar navbar-light bg-light animate__animated animate__fadeIn">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="Notion_App_Logo.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
      <span class="fw-bold">NotNot</span>
    </a>
  </div>
</nav>  
<div class="container min-vh-100 d-flex justify-content-center align-items-center animate__animated animate__fadeIn">
  <form action="forgot_password_process.php" method="post">
    <h1 class="text-center fw-bold animate__animated animate__pulse">Reset Password</h1>
    <?php
      if (isset($_GET['error']) && $_GET['error'] == 1) {
          echo '<div class="alert alert-danger" role="alert">Data yang Anda masukkan tidak valid!</div>';
      }
    ?>
    <div class="mb-2 fw-bold">
      <label for="InputUsername" class="form-label">Username</label>
      <input type="text" class="form-control" name="username" placeholder="Masukkan username Anda">
    </div>
    <div class="mb-2 fw-bold">
      <label for="InputPassword" class="form-label">Password Baru</label>
      <input type="password" class="form-control" name="password" placeholder="Masukkan password baru Anda">
    </div>
    <button type="submit" name="reset_password" class="btn btn-primary w-100">Reset Password</button>
  </form>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>
</html>
