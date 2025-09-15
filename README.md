# freelancerTask
# Tassky - Task Management Dashboard

**Tassky** is a lightweight web-based task management system built with PHP and MySQL. It allows users to manage their tasks with real-time tracking of progress, status filtering, and image attachments. The interface is clean and responsive, with intuitive navigation and user session handling.

---

## 🚀 Features

- 🧑‍💻 User login via PHP sessions
- ✅ Add, edit, delete tasks
- 📊 Visual progress bars for task status:
  - Completed
  - In Progress
  - Not Started
- 🗂️ Task filtering by status
- 🖼️ Image attachment for tasks
- 💡 Light/dark theme toggle (UI only)
- 📅 Current date display
- 🔄 Real-time UI updates using JavaScript

---

## 🛠️ Tech Stack

- **Frontend**: HTML, CSS, JavaScript, Font Awesome
- **Backend**: PHP
- **Database**: MySQL
- **Server**: Apache (recommended)

---

## 📁 Folder Structure

/project-root
│
├── css/
│ └── home.css
├── js/
│ └── home.js
├── img/
│ └── account.jpeg
├── add_task.php
├── delete_task.php
├── update_task.php
├── connect.php
├── logout.php
├── index.php (or login page)
└── home.php (main dashboard)

---
## ⚙️ Installation & Setup 

1. **Clone the Repository**

```bash
git clone https://github.com/Rabab02/freelancerTask.git
cd tassky
```

#2. **Set up Database**

 1.Create a MySQL database named tassky_app (or modify in connect.php)
 2.Import the SQL schema.

# 3. Configure Database Connection
 $conn = mysqli_connect("localhost", "your_username", "your_password", "tassky");

#4. Run the App
Use XAMPP, MAMP, or any local server
Place files in your htdocs or server directory
Navigate to http://localhost/Task - Copy/index.php


# **🧪 Usage
 1.Register or log in to your account
 2.Add new tasks with optional image upload
 3.Track your progress via visual bars
 4.Edit or delete tasks as needed
 5.Filter tasks by their status

# 🤝 Contributing
 Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

# 🙋‍♂️ Author

 Your Name
 GitHub: @Rabab02
 Email: rabab.sahsah@gmail.com

