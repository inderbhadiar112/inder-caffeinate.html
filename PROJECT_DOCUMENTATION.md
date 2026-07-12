# Inder Caffeinate Project Documentation

## Overview
Inder Caffeinate is a coffee-shop themed web project built as a modern landing page with interactive menu browsing, cart flow, contact form handling, and an admin dashboard for managing content and submissions.

This project is designed to work as a lightweight full-stack demo using:
- Frontend: HTML, CSS, and JavaScript
- Backend: PHP
- Database: MySQL

## Purpose
The site is intended to provide:
- An attractive coffee shop landing experience
- A browsable menu with categories and item details
- A shopping cart experience for placing orders
- A contact form for customer inquiries
- An admin panel for viewing messages, menu items, and ratings

## Main Features
### Public Website
- Hero section with branding and call-to-action buttons
- Story section describing the brand
- Menu section with category filters
- Coffee process section
- Gallery section
- Testimonials section
- Contact form
- Cart sidebar with item quantity controls
- Toast notifications and interactive UI effects

### Admin Features
- Login-protected admin panel
- View contact messages
- Manage menu items (add, edit, delete)
- View customer ratings

## Project Structure
- index.html: Main storefront UI and client-side interactions
- index.php: Alternate entry point with similar presentation logic
- admin.php: Admin dashboard interface
- api.php: Backend API for handling menu, messages, orders, ratings, and admin actions
- config.php: Database connection settings
- database.sql: SQL script to create the database schema and sample content
- hero_bg.png: Hero background image asset

## Technology Stack
### Frontend
- HTML5
- CSS3
- Vanilla JavaScript

### Backend
- PHP
- MySQLi

## Database Design
The project uses a MySQL database named inder_cafe with the following main tables:
- menu_items: Stores drink/food items shown on the website
- contact_messages: Stores form submissions from visitors
- orders: Stores completed order summaries
- order_items: Stores individual line items for each order
- ratings: Stores customer review submissions

## How the App Works
1. The browser loads the storefront from index.html or index.php.
2. User interactions such as filtering the menu, adding items to the cart, and submitting contact forms are handled by JavaScript.
3. Requests are sent to api.php.
4. api.php communicates with the MySQL database through config.php.
5. Admin actions are handled through admin.php and the same API layer.


## Notes for Developers
- The current implementation is a demo-style project and is not intended for production without hardening.
- Admin authentication is intentionally simple and should be improved with stronger session-based security in a real deployment.
- Database credentials and other secrets should be managed through environment variables or secure configuration in production.
- The project uses external image URLs for many visuals, so an internet connection may be required for some assets.

## Security Considerations
This documentation intentionally avoids exposing sensitive values such as passwords, private credentials, or internal secrets.

Recommended improvements before production use:
- Replace simple password checks with secure session-based authentication
- Use environment variables for database credentials
- Add CSRF protection for forms and admin actions
- Validate and sanitize all input more strictly
- Use HTTPS in deployment

## Future Enhancements
Possible improvements include:
- A real checkout flow with payment integration
- User accounts and order history
- A content management system for easier menu updates
- Better admin permissions and audit logging
- Responsive refinements and accessibility improvements

## Summary
Inder Caffeinate is a polished single-site coffee shop experience with a lightweight backend for managing menu content and visitor interaction. It is well-suited as a learning project, a portfolio demo, or a foundation for a more complete cafe management system.
