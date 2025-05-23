<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>My Profile - StudyMake</title>
  <link rel="stylesheet" href="../../css/pages/user.css" />
  <link
    href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    rel="stylesheet" />
</head>

<body>
  <header>
    <h1 id="welcome-msg">Welcome...🎓</h1>
    <!--h1 id="welcome-msg">Welcome, User 🎓</h1-->
    <a
      href="../../../server/controller/pages/logout.php"
      class="btn-secondary">Log Out</a>
  </header>

  <main class="user-dashboard">
    <section class="user-info card" id="user-info">
      <h2><i class="bx bx-user-circle"></i> My Profile</h2>
      <!-- Info populated by JS -->
    </section>

    <section class="progress card" id="user-progress">
      <h2><i class="bx bx-bar-chart"></i> Study Progress</h2>
      <!-- Data dynamically loaded -->
    </section>

    <section class="quick-links card">
      <h2><i class="bx bx-fast-forward"></i> Quick Access</h2>
      <ul>
        <li><a href="../../html/page/sessions.html">📚 My Sessions</a></li>
        <li>
          <a
            href="../../../server/controller/page-session/fetch_assignments.php">📝 Assignments</a>
        </li>
        <li><a href="../../../index.html">📅 Study Planner</a></li>
      </ul>
    </section>
  </main>

  <!--script>
    // Fetch user data
    fetch('get_user_data.php')
      .then(res => res.json())
      .then(data => {
        document.getElementById("welcome-msg").innerText = `Welcome, ${data.username} 🎓`;
        document.getElementById("user-info").innerHTML += `
          <p><strong>Username:</strong> ${data.username}</p>
          <p><strong>Email:</strong> ${data.email}</p>
          <p><strong>Member Since:</strong> ${data.joined}</p>
        `;
        document.getElementById("user-progress").innerHTML += `
          <p>Sessions Completed: ${data.sessions_completed}</p>
          <p>Assignments Submitted: ${data.assignments}</p>
          <p>Next Session: ${data.next_session}</p>
        `;
      })
      .catch(() => alert("Failed to load user data."));
  </script-->

  <script src="../../js/pages/user.js"></script>
</body>

</html>