document.addEventListener("DOMContentLoaded", () => {
    fetch("get_user_data.php")
      .then(response => {
        if (!response.ok) throw new Error("Not logged in");
        return response.json();
      })
      .then(data => {
        const welcomeEl = document.getElementById("welcome-msg");
        welcomeEl.textContent = `Welcome, ${data.username} 🎉`;
      })
      .catch(err => {
        console.error(err);
        document.getElementById("welcome-msg").textContent = "Welcome, Guest!";
      });
  });

  fetch('/server/controller/pages/user.php')
  .then(res => {
    if (!res.ok) throw new Error("Not logged in");
    return res.json();
  })
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
  .catch(() => {
    alert("Please login to access your profile.");
    window.location.href = "frontend\html\page\login.html";
  });

