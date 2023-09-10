# Project Task Manager API

The Project Task Manager API is a RESTful web service developed in Laravel that allows users to manage their tasks and task lists. It provides authentication, user management, and task-related functionalities.

## Table of Contents

- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Authentication](#authentication)
- [User Endpoints](#user-endpoints)
  - [Create an Account (Sign Up)](#create-an-account-sign-up)
  - [Sign In](#sign-in)
  - [Get My Profile](#get-my-profile)
  - [Update Profile](#update-profile)
- [Task List Endpoints](#task-list-endpoints)
  - [See My Task List](#see-my-task-list)
  - [Create Task List](#create-task-list)
  - [Update Task List](#update-task-list)
  - [Delete Task List](#delete-task-list)
  - [See All Tasks in a Task List](#see-all-tasks-in-a-task-list)
  - [Add Tasks to a List](#add-tasks-to-a-list)
- [Task Endpoints](#task-endpoints)
  - [See My Task](#see-my-task)
  - [Create Task](#create-task)
  - [Update Task](#update-task)
  - [Delete Task](#delete-task)
  - [Set the Task Status](#set-the-task-status)
- [Task Status](#task-status)

## Getting Started

### Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP >= 7.4
- Composer
- Laravel (Refer to the Laravel documentation for installation instructions)
- Database (e.g., MySQL, PostgreSQL)

### Installation

1. Clone this repository:

   ```sh
   git clone https://github.com/yourusername/project-task-manager-api.git
   cd project-task-manager-api

2. Install the project dependencies:
