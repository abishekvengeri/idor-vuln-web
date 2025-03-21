# IDOR Vulnerable Machine with Stunning PHP/CSS Interface

This project is an intentionally vulnerable web application designed to demonstrate an **Insecure Direct Object Reference (IDOR)** vulnerability. Built with PHP, SQLite, and pure CSS, it features a visually striking, futuristic interface with gradients, glassmorphism, and animations. The app allows users to log in and view profiles, but due to the IDOR flaw, anyone can access other users' profiles by manipulating a URL parameter.



---

## Features
- **Stunning Interface**: Cyberpunk-inspired design with gradients, glowing effects, floating animations, and glassmorphism.
- **IDOR Vulnerability**: Allows unauthorized access to user profiles by changing the `id` parameter in the URL.
- **SQLite Database**: Lightweight storage for user data (username, password, bio).
- **PHP Backend**: Simple login system and profile viewer.
- **Pure CSS**: No external frameworks, just custom CSS for a sleek look.

---

## Prerequisites
- Ubuntu Server 
- PHP with SQLite3 support
- Apache web server


---

## Setup Instructions (Ubuntu Server)

### 1. Install Dependencies
Update your system and install required packages:
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install php php-sqlite3 apache2 sqlite3 -y
