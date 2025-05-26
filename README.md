# Task Tracker 📝

🚀 Task Tracker CLI with Laravel
Task Tracker CLI is a simple command-line interface (CLI) project built with Laravel to manage tasks. You can add, update, delete tasks, and manage their status (e.g., "pending", "in-progress", "completed") directly from the terminal.

📋 Requirements
Before getting started, make sure you have the following installed:

PHP 8.1 or higher
Composer (for dependency management)
MySQL (for local database usage)
🛠️ Getting Started

1. Clone the Repository
Clone this project to your local machine:

git clone (https://github.com/MaxwelldanielR/Task-Tracker-Repositories.git)
cd task-tracker


🖥️ Using the Task Tracker CLI
After setting up the environment, you can use the following commands to manage tasks.

Add a New Task
To add a new task, run:

php artisan app:add-task "Your task description"

Example:

php artisan app:add-task "Buy groceries"

This will create a new task with the description "Buy groceries" and store it in your SQLite database.

List All Tasks
To list all tasks, run:

php artisan app:list-tasks

Update a Task Status
To update the status of a task, use the following command:

php artisan app:update-status {task_id} {new_status}

Where {task_id} is the ID of the task and {new_status} can be one of the following: pending, in-progress, completed.

Example:

php artisan app:update-status 1 "completed"

This will update the task with ID 1 to the status "completed".

Update a Task Description
To update a task's description, use the following command:

php artisan app:update-task {task_id} {new_description}

Delete a Task
To delete a task, run:

php artisan app:delete-task {task_id}

🧪 Testing the Commands
To test that the commands are working correctly, you can run:

php artisan help app:add-task

This will show you how the command should be used.

🌐 Roadmap

For more information on the development roadmap and upcoming features, check out our roadmap:

Task Tracker Roadmap

🤝 Contributing
If you want to contribute to this project, feel free to fork it, create a new branch, make changes, and submit a pull request. Please ensure that your code is well-tested.

📄 License
This project is open-source and available under the MIT License

