# RR Boarding House Management System

## Project Overview
The RR Boarding House Management System is a web application designed to help manage boarding house operations. It allows administrators to handle tenants, rooms, bed assignments, invoices, and payments while maintaining digital records.

<img src="https://github.com/HawtStrokes/RR_Boarding_House/blob/main/res/sample.png">

## Features
- Tenant Management – Add, update, and manage tenant details.
- Room & Bed Management – Assign tenants to available rooms and beds.
- Invoices & Payments – Generate invoices and track payments.
- Activity Logs – Monitor system activity and user actions.
- User Roles & Authentication – Secure login system for admins and users.
- Backup & Restore – Automatically back up database records.

## Technologies Used
- MySQL
- PHP
- Bootstrap

## Project Structure
```
├── public/               # Frontend assets
├── resources/views/      # Blade templates for UI
├── app/Http/Controllers/ # Backend logic
├── database/migrations/  # Database schema
├── routes/web.php        # Web routes
├── .env                  # Environment variables
├── README.md             # Project documentation
```

## Usage
- Admin Login: Use the credentials provided in the database seed.
- Create Rooms & Beds: Navigate to the management panel to add new rooms and beds.
- Manage Tenants: Assign tenants to beds and track rental payments.
- Generate Invoices & Payments: Monitor and process payments.

