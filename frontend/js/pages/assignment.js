const assignments = JSON.parse(localStorage.getItem("assignments")) || [];

function renderAssignments() {
  const assignmentList = document.getElementById("assignment-list");
  assignmentList.innerHTML = "";

  if (assignments.length === 0) {
    assignmentList.innerHTML = "<p>No assignments added yet.</p>";
    return;
  }

  assignments.forEach((task, index) => {
    const div = document.createElement("div");
    div.className = "assignment-item";
    div.innerHTML = `
      <strong>${task.subject}</strong><br>
      <span>${task.description}</span><br>
      <small>Due: ${task.dueDate}</small><br>
      <button class="delete-assignment" data-index="${index}">Delete</button>
    `;
    assignmentList.appendChild(div);
  });

  attachDeleteListeners();
}

function attachDeleteListeners() {
  document.querySelectorAll(".delete-assignment").forEach((button) => {
    button.addEventListener("click", (e) => {
      const index = e.target.getAttribute("data-index");
      assignments.splice(index, 1);
      localStorage.setItem("assignments", JSON.stringify(assignments));
      renderAssignments();
    });
  });
}

document
  .getElementById("open-assignment-form")
  .addEventListener("click", () => {
    const subject = document.getElementById("assignment-subject").value.trim();
    const description = document.getElementById("assignment-desc").value.trim();
    const dueDate = document.getElementById("assignment-date").value;

    if (!subject || !description || !dueDate) {
      alert("Please fill in all fields.");
      return;
    }

    assignments.push({ subject, description, dueDate });
    localStorage.setItem("assignments", JSON.stringify(assignments));

    document.getElementById("assignment-subject").value = "";
    document.getElementById("assignment-desc").value = "";
    document.getElementById("assignment-date").value = "";

    renderAssignments();
  });

window.addEventListener("DOMContentLoaded", renderAssignments);

function saveAssignment() {
  const subject = document.getElementById("subject").value.trim();
  const task = document.getElementById("assignment").value.trim();
  const dueDate = document.getElementById("due_date").value;

  if (subject && task && dueDate) {
    const assignment = {
      subject,
      task,
      dueDate,
    };

    let assignments = JSON.parse(localStorage.getItem("assignments")) || [];
    assignments.push(assignment);
    localStorage.setItem("assignments", JSON.stringify(assignments));

    // Redirect to assignments page
    window.location.href = "assignments.php";
  } else {
    alert("Please fill in all assignment fields.");
  }
}

document
  .getElementById("open-assignment-form")
  .addEventListener("click", function () {
    const subject = document.getElementById("assignment-subject").value.trim();
    const description = document.getElementById("assignment-desc").value.trim();
    const dueDate = document.getElementById("assignment-date").value;

    const wordCount = description
      .split(/\s+/)
      .filter((word) => word.length > 0).length;

    if (!subject || !description || !dueDate) {
      alert("Please fill in all fields.");
      return;
    }

    if (wordCount < 180) {
      alert(
        `Assignment must be at least 180 words. Current word count: ${wordCount}`
      );
      return;
    }

    // Submit the data (AJAX or form submission here)
    alert("Assignment submitted successfully!");
  });
