<?php
session_start();
include 'database.php';
include 'header.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $q_login = "SELECT user_id, username FROM datauser WHERE username = '$username' AND password = '$password'";
    $run_q_login = mysqli_query($conn, $q_login);

    if (mysqli_num_rows($run_q_login) == 1) {
        $user_data = mysqli_fetch_assoc($run_q_login);
        $_SESSION['user'] = $user_data;

        header('Location: index.php');
        exit();
    } else {
        echo "Username atau password salah.";
    }
}

include 'database.php';

if (isset($_POST['add'])) {
  $task_label = $_POST['task'];
  $task_desc = $_POST['task_desc'];
  $task_deadline = $_POST['task_deadline'];

  if (empty($task_label) || empty($task_desc) || empty($task_deadline)) {
        echo "All fields are required.";
    } else {
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user']['user_id'];
          } else {
            header('Location: login.php');
          }
          $task_deadline = date('Y-m-d H:i:s', strtotime($task_deadline));
          $taskstatus = 'open';

          $q_insert = "INSERT INTO tasks (tasklabel, task_desc, task_deadline, taskstatus, user_id) VALUES ('$task_label', '$task_desc', '$task_deadline', '$taskstatus', $user_id)";
          $run_q_insert = mysqli_query($conn, $q_insert);

          if ($run_q_insert) {
              header('Refresh:0; url=index.php');
          }
    }
}

if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['user_id'];

    $q_select = "SELECT * FROM tasks WHERE user_id = $user_id ORDER BY taskid DESC";
    $run_q_select = mysqli_query($conn, $q_select);
} else {
    header('Location: login.php');
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $q_delete = "DELETE FROM tasks WHERE taskid = $id";
    $run_q_delete = mysqli_query($conn, $q_delete);

    if ($run_q_delete) {
        header('Refresh:0; url=index.php');
    } else {
    }
}

if (isset($_GET['done'])) {
    $status = 'close';

    if ($_GET['status'] == 'open') {
        $status = 'close';
    } else {
        $status = 'open';
    }

    $q_update = "UPDATE tasks SET taskstatus = '$status' WHERE taskid = '" . $_GET['done'] . "'";
    $run_q_update = mysqli_query($conn, $q_update);

    header('Refresh:0; url=index.php');
}
?>
      <?php
      $tasks_open = array();
      $tasks_close = array();

      if (mysqli_num_rows($run_q_select) > 0) {
          while ($r = mysqli_fetch_array($run_q_select)) {
              $task_deadline = date('Y-m-d H:i', strtotime($r['task_deadline']));

              if ($r['taskstatus'] == 'open') {
                  $tasks_open[] = $r;
              } else {
                  $tasks_close[] = $r;
              }
          }
      }
      if (isset($_POST['task_deadline'])) {
        $task_deadline = $_POST['task_deadline'];
      } else {
      }

      foreach ($tasks_open as $r) {
        $status = ($r['taskstatus'] == 'open') ? 'On Progress' : 'Done';
            ?>
          <div class="container mb-3">
            <div class="task-item <?= $r['taskstatus'] == 'close' ? 'done' : '' ?>">
                <div>
                  <input type="checkbox" onclick="window.location.href = '?done=<?= $r['taskid'] ?>&status=<?= $r['taskstatus'] ?>'" <?= $r['taskstatus'] == 'close' ? 'checked' : '' ?>>
                  <span class="task-label"><?= $r['tasklabel'] ?></span>
                  <span class="task-deadline"><?= date('Y-m-d H:i', strtotime($r['task_deadline'])) ?></span>
                  <span class="task-status" data-status="<?= $status ?>"><?= $status ?></span>
                  <div class="task-desc hidden" id="task-description-<?= $r['taskid'] ?>"> <?= $r['task_desc'] ?> </div>
                </div>

                <div class="task-actions text-right">
                  <a href="edit.php?id=<?= $r['taskid'] ?>" class="text-orange" title="Edit"><i class="bx bx-edit"></i></a>
                  <a href="?delete=<?= $r['taskid'] ?>" class="text-red" title="Remove" onclick="return confirm('Hapus Task?')"><i class="bx bx-trash"></i></a>
                </div>
              </div>
            </div>
        <?php
      }
      foreach ($tasks_close as $r) {
        $status = ($r['taskstatus'] == 'open') ? 'On Progress' : 'Done';
          ?>
          <div class="container mb-3">
              <div class="task-item <?= $r['taskstatus'] == 'close' ? 'done' : '' ?>">
                  <div>
                    <input type="checkbox" onclick="window.location.href = '?done=<?= $r['taskid'] ?>&status=<?= $r['taskstatus'] ?>'" <?= $r['taskstatus'] == 'close' ? 'checked' : '' ?>>
                    <span class="task-label"><?= $r['tasklabel'] ?></span>
                    <span class="task-deadline"><?= date('Y-m-d H:i', strtotime($r['task_deadline'])) ?></span>
                    <span class="task-status" data-status="<?= $status ?>"><?= $status ?></span>
                    <div class="task-desc hidden" id="task-description-<?= $r['taskid'] ?>"> <?= $r['task_desc'] ?> </div>
                    </div>
                    
                    <div class="task-actions text-right">
                    <a href="edit.php?id=<?= $r['taskid'] ?>" class="text-orange" title="Edit"><i class="bx bx-edit"></i></a>
                    <a href="?delete=<?= $r['taskid'] ?>" class="text-red" title="Remove" onclick="return confirm('Hapus Task?')"><i class="bx bx-trash"></i></a>
                    </div>
                  </div>
              </div>
          <?php
        } 
        if (empty($tasks_open) && empty($tasks_close)) {
            ?>
            <div class="alert alert-info text-center">Task not available</div>
            <?php
        }
        ?>
  </div>
  </div>
  
  <script>
    function toggleTaskDescription(taskId) {
      var taskDesc = document.getElementById("task-desc-" + taskId);

      if (taskDesc.style.display === "none" || taskDesc.style.display === "") {
        taskDesc.style.display = "block";
      } else {
        taskDesc.style.display = "none";
      }
    }
    function searchTasks() {
        var input = document.getElementById("search").value.toLowerCase();
        var taskContainers = document.querySelectorAll(".container.mb-3");

        taskContainers.forEach(function(container) {
            var taskLabel = container.querySelector(".task-label");
            if (taskLabel) {
                var label = taskLabel.textContent.toLowerCase();
                if (label.includes(input)) {
                    container.style.display = "block";
                } else {
                    container.style.display = "none";
                }
            }
        });
    }
  
   function validateForm() {
        var task = document.querySelector('input[name="task"]').value;
        var task_desc = document.querySelector('textarea[name="task_desc"]').value;
        var task_deadline = document.querySelector('input[name="task_deadline"]').value;

        if (task.trim() === "" || task_desc.trim() === "" || task_deadline.trim() === "") {
            alert("Please fill in all required fields.");
            return false;
        }

        return true;
    }
  </script>