<?php
session_start();
include("connect.php");

// Get all tasks for the user (for bars section)
$email = $_SESSION['email'];
$query = "SELECT task_status FROM tasks WHERE task_owner = '$email'";
$result = mysqli_query($conn, $query);

$totalTasks = 0;
$completed = 0;
$inProgress = 0;
$notStarted = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $totalTasks++;
    switch ($row['task_status']) {
        case 'completed':
            $completed++;
            break;
        case 'in-progress':
            $inProgress++;
            break;
        case 'not-started':
            $notStarted++;
            break;
    }
}


if ($totalTasks === 0) {
    $completedPercent = $inProgressPercent = $notStartedPercent = 0;
} else {
    $completedPercent = round(($completed / $totalTasks) * 100);
    $inProgressPercent = round(($inProgress / $totalTasks) * 100);
    $notStartedPercent = round(($notStarted / $totalTasks) * 100);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="light">
    <!-- header section -->
    <header>
        <div class="toggle">
            <i class="fa fa-bars"></i>
        </div>
        <div class="logo">
            <a href="#">
                <h2>Tassky</h2>
            </a>
        </div>
        <div class="right-top"> 
            <div class="date">
            <p id="dateDisplay"></p>
        </div>
        <div class="theme">
            <a href="#"><i class="fa-solid fa-sun"></i></a>
           <a href="#"><i class="fa-solid fa-moon"></i></a>
            <div class="overlay"></div>
        </div>
        </div>
    </header>

    <!-- left nav section -->
     <nav class="left-nav">
        <div class="exit">
            <i class="fas fa-times"></i>
        </div>
        <div class="profile-details">
           <div class="img-container">
              <img src="img/account.jpeg" alt="profile-img">
           </div>
           <h3 class="name">
            <?php 
                if(isset($_SESSION['email'])){
                $email=$_SESSION['email'];
                $query=mysqli_query($conn, "SELECT accounts.* FROM `accounts` WHERE accounts.email='$email'");
                while($row=mysqli_fetch_array($query)){
                   echo $row['name'];
                 }
                }
            ?>
           </h3>
           <h5 class="email">
            <?php 
                if(isset($_SESSION['email']))
                $email=$_SESSION['email'];
                   echo $email;
                
            ?>
           </h5>
        </div>
        
        <div class="tabs">
            <div class="element active" id="dashboard">
                <a href="#">
                    <i class="fa fa-th-list"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="element" id="add-tasks">
                <a href="#">
                    <i class="fa fa-plus"></i>
                    <span>Add Task</span>
                </a>
            </div>
            <div class="element" id="task-categories">
                <a href="#">
                    <i class="fa fa-list-ul"> </i>
                    <span>Task categories</span>
                </a>
            </div>
        </div>

        <div class="logout-tab">
            <div class="log-out-btn">
                <button onclick="location.href='logout.php'">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span>
                </button>
            </div>
        </div>
     </nav>

     <!-- dashboard section -->
      <section id="dashboard" class="dashboard active">
          <h2>
            <span>Welcome back, 
              <?php 
                if(isset($_SESSION['email'])){
                $email=$_SESSION['email'];
                $query=mysqli_query($conn, "SELECT accounts.* FROM `accounts` WHERE accounts.email='$email'");
                while($row=mysqli_fetch_array($query)){
                   echo $row['name'];
                 }
                }
              ?>
            </span>
            <i class="fa fa-hand-paper"></i>
          </h2>

          <div class="windows">
            <div class="to-do-window">
                    <div class="title">
                    <span>
                        <i class="fa fa-clock" aria-hidden="true"></i>
                        To-Do
                    </span>
                    <a href="#">
                        <span>
                        <i class="fa fa-plus"></i>
                        Add Task
                    </span>
                    </a>
                </div>
                <div class="date" id="date"></div>
                <?php 
                            $email = $_SESSION['email'];
                            $query = "SELECT * FROM tasks WHERE task_owner = '$email'";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                             $status = $row['task_status'];
                             $title = htmlspecialchars($row['task_title']);
                             $details = htmlspecialchars($row['task_details']);
                             $img = htmlspecialchars($row['task_img']);
                             
                             if($status <> "completed")
                             echo "  <div class='today-tasks'>
                                       <div class='window-details'>
                                         <div class='status' data-status='$status'></div>
                                         <div class='para'>
                                           <div class='title'>$title</div>
                                           <div class='details'>$details</div>
                                         </div>
                                         <div class='img-container'>
                                           <img src='$img' alt='image task'>
                                         </div>
                                        </div>
                                      </div>";
                            }
                ?>
          </div>

          <div class="task-status-window">
             <div class="title">
                <span>
                    <i class="fa fa-spinner"></i>
                    Task Status
                </span>
             </div>

             <div class="progress-bars">
    <span>completed</span>
    <div class="bar">
        <div class="bar-inner completed" style="width: <?= $completedPercent ?>%; background-color: green;">
            <?= $completedPercent ?>%
        </div>
    </div>

    <span>in progress</span>
    <div class="bar">
        <div class="bar-inner in-progress" style="width: <?= $inProgressPercent ?>%; background-color: blue;">
            <?= $inProgressPercent ?>%
        </div>
    </div>

    <span>not started</span>
    <div class="bar">
        <div class="bar-inner not-started" style="width: <?= $notStartedPercent ?>%; background-color: red;">
            <?= $notStartedPercent ?>%
        </div>
    </div>
</div>

          </div>

          <div class="completed-tasks-window">
            <div class="title">
                <i class="fa fa-calendar-check"></i>
                Task Completed
            </div>

              <?php 
                            $email = $_SESSION['email'];
                            $query = "SELECT * FROM tasks WHERE task_owner = '$email'";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                             $status = $row['task_status'];
                             $title = htmlspecialchars($row['task_title']);
                             $details = htmlspecialchars($row['task_details']);
                             $img = htmlspecialchars($row['task_img']);
                             
                             if($status == "completed") 
                                echo "<div class='completed-tasks'>
                                         <div class='window-details'>
                                         <div class='status'></div>
                                         <div class='para'>
                                             <div class='title'>$title</div>
                                             <div class='details'>$details</div>
                                         </div>
                                         <div class='img-container'>
                                             <img src='$img' alt='image task'>
                                         </div>
                                        </div>
                                       </div>";
                            }
               ?>
          </div>
        </div>
      </section>

      <!-- add task section -->
      <section class="add-task" id="add-tasks">
           <div class="add-task-container">
            <div class="title">
              add task form
              <span>
             <i class="fa fa-times"></i>
           </span>
        </div>
           <form action="add_task.php" method="POST" enctype="multipart/form-data">
               <input type="text" id="taskTitle" name="taskTitle" placeholder="Task Title" required>
               <input type="text" id="taskDetails" name="taskDetails" placeholder="Task Details" required>
               <input type="file" id="taskImage" name="taskImage" accept="image/*">
               <input type="submit" value="Add">
           </form>  
           </div>
      </section>

      <!-- task categories section -->
       <section class="task-categories" id="task-categories">
            <div class="task-categories-container">
                 <h2>My Tasks</h2>
                <div class="filter-container">
                    <span class="active" data-selection="all">all</span>
                    <span data-selection="not-started">not started</span>
                    <span data-selection="in-progress">in progress</span>
                    <span data-selection="completed">completed</span>
                </div>
        
                <div class="tasks">
                        <?php 
                            $email = $_SESSION['email'];
                            $query = "SELECT * FROM tasks WHERE task_owner = '$email'";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                             $status = $row['task_status'];
                             $title = htmlspecialchars($row['task_title']);
                             $details = htmlspecialchars($row['task_details']);
                             $img = htmlspecialchars($row['task_img']);

                            echo "
                                    <div class='task'>
                                      <div class='task-status' data-status='$status'></div>
                                         <div class='left-side'>
                                         <div class='title'>$title</div>
                                     <div class='details'>$details</div>
                                    <div class='btn-container'>
                                       <button class='edit-btn' 
                                         data-task-id='" . $row['id'] . "'
                                         data-title='" . htmlspecialchars($row['task_title'], ENT_QUOTES) . "'
                                         data-details='" . htmlspecialchars($row['task_details'], ENT_QUOTES) . "'
                                         data-status='" . $row['task_status'] . "'>
                                         Edit
                                       </button>

                                        <form method='POST' action='delete_task.php' style='display:inline;'>
                                          <input type='hidden' name='task_id' value='" . $row['id'] . "'>
                                          <button type='submit'>Delete</button>
                                        </form>
                                    </div>
                                     </div>
                                     <div class='right-side'>
                                         <img src='$img' alt='task image'>
                                    </div>
                                    </div>";
                            }
                        ?>
                </div>
            </div>
       </section>

       <!-- edit modal -->
        <div class="modal-container">
            <div id="editModal" class="modal">
          <h3>Edit Task</h3>
    <form id="editTaskForm">
        <input type="hidden" id="editTaskId" name="task_id">
        <input type="text" id="editTaskTitle" name="taskTitle" placeholder="Title" required><br>
        <input type="text" id="editTaskDetails" name="taskDetails" placeholder="Details" required><br>
        <label for="editTaskStatus">The Status</label>
        <select id="editTaskStatus" name="taskStatus">
            <option value="not-started">Not Started</option>
            <option value="in-progress">In Progress</option>
            <option value="completed">Completed</option>
        </select><br>
        <button type="submit">Save</button>
        <button type="button" onclick="closeEditModal()">Cancel</button>
    </form>
</div>
        </div>

</body>
<script src="js/home.js"></script>
 <script>
    const currentDate = new Date();
    const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const dayName = dayNames[currentDate.getDay()];
    const day = String(currentDate.getDate()).padStart(2, '0');
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const year = currentDate.getFullYear();

    const formattedDate = `${dayName}, ${day}/${month}/${year}`;
    document.getElementById("dateDisplay").textContent = formattedDate;
    document.getElementById("date").textContent = `${day} / ${month} . Today`;
  </script>

  <script>
    function closeEditModal() {
    document.querySelector(".modal-container").style.visibility = "hidden";
}

document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function () {
        document.querySelector(".modal-container").style.visibility = "visible";

        document.getElementById("editTaskId").value = this.dataset.taskId;
        document.getElementById("editTaskTitle").value = this.dataset.title;
        document.getElementById("editTaskDetails").value = this.dataset.details;
        document.getElementById("editTaskStatus").value = this.dataset.status;
    });
});

document.getElementById("editTaskForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("update_task.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(response => {
        console.log(response);

        location.reload();
    })
    .catch(error => {
        console.error("Error:", error);
    });
});
</script>

</html>