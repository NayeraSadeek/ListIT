# 📋 Daily Task Tracker – Laravel 12 + Blade + Tailwind CSS

A practical task management web application built using **Laravel 12**, **Blade**, and **Tailwind CSS v4**. This project helps users manage their daily tasks, organize them into categories, track progress, and schedule recurring tasks via Artisan commands.

---

## 🚀 Features

✅ **User Authentication** (Login, Register)
✅ **Task Management (CRUD)**
✅ **Category Management (CRUD)**
✅ **Task Filtering by Category**
✅ **Progress Tracking**
✅ **Recurring Task Scheduling** (via `php artisan`)
✅ **Blade Templating + Tailwind Styling**
✅ **Dynamic Dashboard for Users**

---

## 🎯 Learning Objectives

This beginner-to-intermediate project (Difficulty: ★★☆☆☆ 2/5) reinforces Laravel fundamentals:

- Laravel routing and controller structure
- Blade view rendering
- Eloquent ORM for database interaction
- Form handling with validation
- Tailwind CSS basics (utility-first styling)
- Laravel Artisan commands and task scheduling
- Environment config and deployment basics

---

## 🛠 Tech Stack

| Layer        | Tool                         |
|--------------|------------------------------|
| Backend      | Laravel 12                   |
| Frontend     | Blade, Tailwind CSS v4       |
| Database     | MySQL                        |
| Authentication | Laravel Breeze             |
| Scheduler    | Laravel Artisan Commands     |

---

## 📦 Installation
1-Clone Repository git clone https://github.com/NayeraSadeek/ListIT

2-Install dependencies composer install npm install npm run dev

3-Copy .env and generate app key cp .env.example .env php artisan key:generate

4-Configure .env Edit your .env file and set your database credentials: 
DB_CONNECTION=mysql 
DB_HOST=127.0.0.1 
DB_PORT=3307
DB_DATABASE=dailytasktracker
DB_USERNAME=root
DB_PASSWORD=

5-Run migrations php artisan migrate

6-Serve the application php artisan serve 


## 🧪 Testing (PHPUnit)
php artisan test
Includes feature tests for:

✅ Authentication

✅ Task creation and listing

✅ Profile update and account deletion

## ⏰ Scheduling Recurring Tasks
php artisan app:generate-recurring-tasks

## 📤 Deployment Notes
composer install --no-dev --optimize-autoloader
php artisan migrate --force
npm run build
Make sure your .env is configured properly