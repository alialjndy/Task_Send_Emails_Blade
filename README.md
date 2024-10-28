# Task Blade System

## Overview

**Task Blade System** is a task management application that allows users to perform CRUD operations on tasks. It also includes a feature that sends a daily email to each user with a list of tasks that have a "Pending" status.

## Requirements

Make sure the following are installed on your system before running the application:

-   PHP Version 8.3 or earlier
-   Laravel Version 11 or earlier
-   composer
-   XAMPP: Local development environment (or a similar solution)

## Send Daily Emails

1. **Create Mail**: Start by creating a new mail class called `StatusEmail`. This mail class will handle the structure and content of the email that includes the list of tasks with a "Pending" status.

    ```bash
    php artisan make:mail StatusEmail
    ```

2. Create Job: Next, create a job to send emails in the background. This job will process the email sending task asynchronously, which helps improve performance and ensures the main application flow isn't interrupted

    ```bach
        php artisan make:job SendStatusEmail
    ```

3. Create Command: Finally, create a custom command to schedule this job to run daily. This command will be responsible for triggering the email-sending job at a set time each day.
    ```bach
    php artisan make:command SendDailyStatusEmails
    ```

## Views

### send email example

![Reference Image](/screenshot/pending%20status%20tasks%20-%20alialjndy2@gmail.com%20-%20Gmail%20-%20Google%20Chrome%2010_29_2024%201_46_40%20AM.png)
