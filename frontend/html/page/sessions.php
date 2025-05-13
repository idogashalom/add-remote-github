  <?php
  //check if the session is started or start it
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  //check if the user is logged in or not
  //if the user is not logged in redirect to login page
  if (!isset($_SESSION['_id'])) {
    echo "<script>
        alert('User must login first');
        window.location.href='../../../login.html';
    </script>";
    exit();
  }
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Study Planner</title>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/pages/sessions.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../../css/pages/style.css" />
  </head>

  <body>

    <nav class="navbar">
      <div class="logo">📚 StudyMake</div>
      <button id="menuToggle" class="menu-toggle"><i class='bx bx-menu'></i></button>
      <ul class="nav-links" id="navLinks">
        <li><a href="../../../index.html"><i class='bx bxs-home'></i>Home</a></li>
        <li><a href="../../html/page/user.php"><i class='bx bxs-user-pin'></i>User</a></li>
        <!--li><a href="/frontend/html/sessions.html"><i class='bx bxs-graduation'></i>My Sessions</a></li-->
        <li><a href="#dashboard"><i class='bx bxs-bar-chart-alt-2'></i>Analytics</a></li>
        <li><a href="../../../server/controller/pages/logout.php"><i class='bx bx-log-out'></i>Logout</a></li>
        <li><button id="toggleDark" title="Toggle Dark Mode"><i class='bx bx-moon'></i></button></li>
      </ul>
    </nav>

    <!-- Sidebar (for mobile) -->
    <!--aside class="sidebar" id="mobileSidebar">
    <ul>
      <li><a href="/frontend/index.html"><i class='bx bxs-home' ></i>Home</a></li>
      <li><a href="/frontend/html/page/user.html"><i class='bx bxs-user-pin' ></i>User</a></li>
      <!--li><a href="/frontend/html/sessions.html"><i class='bx bxs-graduation'></i>My Sessions</a></li-->
    <!--li><a href="#">✨Features</a></li-->
    <!--li><a href="#"><i class='bx bxs-bar-chart-alt-2'></i>Leadership Board</a></li-->
    <!--li><a href="#"><i class='bx bxs-dashboard'></i>Dashboard</a></li-->
    <!--li><a href="#"><i class='bx bx-notepad' ></i>Assignment</a></li-->
    <!--li><a href="/frontend/index.html"><i class='bx bx-log-out'></i>Logout</a></li>
      <!--li><button id="toggleDark" title="Toggle Dark Mode"><i class='bx bx-moon'></i></button></li>
    <!--/ul>
  <!--/aside-->

    <main class="main-content">

      <!-- Study Session Section -->
      <section class="card_section">
        <h2><i class='bx bx-plus-circle'></i> Add study session</h2>
        <form id="addSessionForm" method="POST" action="../../../server/controller/page-session/save_session.php">
          <input type="text" name="title" placeholder="Session Title" required>
          <input type="text" name="subject" placeholder="Subject" required>
          <input type="time" name="start_time" placeholder="Start Time" required>
          <input type="time" name="end_time" placeholder="End Time" required>
        </form>
        <button id="open-session-form" class="btn-primary">New Session</button>
      </section>

      <!-- To-do-list Section -->
      <section class="card-to-do-list">
        <h2><i class='bx bx-list-ul'></i> To-do-list</h2>
        <div class="todo-add">
          <input type="text" id="todo-input" placeholder="Add Task...">
          <button id="add-todo" class="btn-secondary">Add</button>
        </div>
        <div class="tasks" id="task-list"></div>
      </section>

      <!-- Calendar Section -->
      <section class="card-calender">
        <h2><i class='bx bx-calendar'></i> Calendar</h2>
        <div id="calendar"></div>
        <input type="date" name="due_date" required>
      </section>


      <!-- Assignment Section -->
      <section class="card-assignment">
        <h2><i class='bx bx-book-content'></i> Assignment</h2>
        <input type="text" id="assignment-subject" placeholder="Subject Title" required>
        <input type="text" id="assignment-desc" placeholder="Enter Assignment" required>
        <input type="date" id="assignment-date" name="due_date" required>
        <button id="open-assignment-form" class="btn-primary">New Assignment</button>

        <!-- Where assignments will appear -->
        <div id="assignment-list"></div>
      </section>



      <!-- Up-Coming Study Sessions Section -->
      <section class="card-Up-Coming">
        <h2>Up-Coming Study Sessions</h2>
        <div class="upcoming" id="upcoming-sessions">
          <!-- Dynamic upcoming sessions -->
          <button>planned</button>
          <button>complete</button>
        </div>
      </section>


    </main>

    <!-- Session Popup -->
    <div class="popup" id="session-form">
      <div class="popup-content">
        <h3>New Study Session</h3>
        <input type="text" id="session-title" placeholder="Session Title">
        <input type="text" id="session-subject" placeholder="Subject">
        <input type="time" id="session-start">
        <input type="time" id="session-end">
        <button id="save-session" class="btn-primary">Save Session</button>
        <button class="close-btn" onclick="closePopup('session-form')">Close</button>
      </div>
    </div>

    <!-- Assignment Popup -->
    <div class="popup" id="assignment-form">
      <div class="popup-content">
        <h3>New Assignment</h3>
        <input type="text" id="assignment-subject" placeholder="Subject Title">
        <textarea id="assignment-question" placeholder="Question"></textarea>
        <input type="date" id="assignment-date">
        <button id="save-assignment" class="btn-primary">Save Assignment</button>
        <button class="close-btn" onclick="closePopup('assignment-form')">Close</button>
      </div>
    </div>

    <audio id="alarm-sound" src="https://assets.mixkit.co/sfx/preview/mixkit-classic-alarm-995.mp3"></audio>

    <script src="../..//js/pages/sessions.js"></script>
    <script src="../../js/pages/darkmode.js"></script>
    <!--script src="../../js/pages/navbar.js"></script-->
    <script src="../../js/pages/upcoming.js"></script>
    <script src="../../js/pages/assignment.js"></script>
    <!--script src="../../js/pages/authGuard.js"></script-->
    <script src="../../js/pages/to-do-list.js"></script>
  </body>

  </html>