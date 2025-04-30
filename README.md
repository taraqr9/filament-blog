<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
  </a>
</p>

<h2 align="center">AI-Enhanced Blog Platform</h2>

A modern blog site built using Laravel 12 and PHP 8.3 with advanced features like role-based access control, subscription support, and built-in AI assistant powered by **Anthropic AI**.

---

## 🚀 Features

- Authentication & Registration
- Role & Permission Management
- Blog Post Creation & Editing
- Image Uploads & Rich Text Editor
- Subscriber System (Mail Ready)
- Integrated **Anthropic AI Assistant** (Chat Interface)
- Responsive Design with Tailwind CSS
- Admin Panel via Filament v3
- Dockerized Setup (Ready to Deploy)

---

## 🧰 Tech Stack

- **Laravel** 12
- **PHP** 8.3
- **Filament** v3
- **Tailwind CSS**
- **Docker** + Docker Compose

---

## 📦 Installation (Docker)

```bash
git clone https://github.com/taraqr9/filament-blog
cd filament-blog
composer install
npm install
cp .env.example .env
```

After copying the .env file, make sure to set your Anthropic API key:
```aiignore
ANTHROPIC_API_KEY=your_api_key_here
```
⚠️ Without ANTHROPIC_API_KEY, the AI Assistant will not work. <br><br>
Then continue:
```
php artisan key:generate
php artisan migrate --seed
```

You're now ready to go! <br>
If you prefer to run the project in Docker, simply execute:
```
./start
```
