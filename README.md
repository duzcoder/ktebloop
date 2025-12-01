# 📚 Ktebloop – Share Your Books for Free

Ktebloop is a Laravel PHP web platform to share, exchange, and discover books for free.  
Join an eco-friendly community and give your books a second life! 🌱✨

---

## 🚀 Main Features

### 📖 Book Sharing
- Easily publish your books
- Intuitive interface for managing your publications

### 🔍 Smart Discovery
- Search by keywords
- Filter by categories
- Personalized book suggestions

### 🤝 Exchanges & Community
- Meet members with similar tastes
- Exchange books locally or online

### 🌿 Eco-Friendly Impact
- Reduce waste
- Promote circular economy
- Encourage reuse and sharing

---

## 🖥️ Technologies Used
- **Backend:** PHP 8.x, Laravel 10
- **Frontend:** HTML5, CSS3, custom Tailwind-like styles
- **Database:** MySQL / MariaDB
- **Authentication:** Laravel Breeze / Jetstream
- **Icons & Fonts:** Font Awesome, Google Fonts Inter

---

## 🗂️ Project Structure
ktebloop/
├── .editorconfig
├── .env.example
├── .gitattributes
├── .gitignore
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   ├── ConfirmablePasswordController.php
│   │   │   │   ├── EmailVerificationNotificationController.php
│   │   │   │   ├── EmailVerificationPromptController.php
│   │   │   │   ├── NewPasswordController.php
│   │   │   │   ├── PasswordController.php
│   │   │   │   ├── PasswordResetLinkController.php
│   │   │   │   ├── RegisteredUserController.php
│   │   │   │   └── VerifyEmailController.php
│   │   │   ├── BookController.php
│   │   │   ├── Controller.php
│   │   │   ├── DashboardController.php
│   │   │   ├── HomeController.php
│   │   │   ├── ProfileController.php
│   │   │   └── ReservationController.php
│   │   └── Requests/
│   │       ├── Auth/
│   │       │   └── LoginRequest.php
│   │       └── ProfileUpdateRequest.php
│   ├── Models/
│   │   ├── Book.php
│   │   ├── Reservation.php
│   │   └── User.php
│   ├── Providers/
│   │   └── AppServiceProvider.php
│   └── View/
│       └── Components/
│           ├── AppLayout.php
│           └── GuestLayout.php
├── artisan
├── bootstrap/
│   ├── app.php
│   ├── cache/
│   └── providers.php
├── composer.json
├── composer.lock
├── config/
├── database/
│   ├── .gitignore
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│       ├── BookSeeder.php
│       ├── DatabaseSeeder.php
│       └── UserSeeder.php
├── LICENSE
├── package-lock.json
├── package.json
├── phpunit.xml
├── postcss.config.js
├── public/
│   ├── .htaccess
│   ├── favicon.ico
│   ├── index.php
│   └── robots.txt
├── README.md
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/
│       ├── admin/
│       │   ├── books.blade.php
│       │   ├── create-user.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── edit-user.blade.php
│       │   └── users.blade.php
│       ├── auth/
│       │   ├── app.blade.php
│       │   ├── confirm-password.blade.php
│       │   ├── forgot-password.blade.php
│       │   ├── login.blade.php
│       │   ├── register.blade.php
│       │   ├── reset-password.blade.php
│       │   └── verify-email.blade.php
│       ├── book-reservations.blade.php
│       ├── books/
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── components/
│       │   ├── application-logo.blade.php
│       │   ├── auth-session-status.blade.php
│       │   ├── danger-button.blade.php
│       │   ├── dropdown-link.blade.php
│       │   ├── dropdown.blade.php
│       │   ├── input-error.blade.php
│       │   ├── input-label.blade.php
│       │   ├── modal.blade.php
│       │   ├── nav-link.blade.php
│       │   ├── primary-button.blade.php
│       │   ├── responsive-nav-link.blade.php
│       │   ├── secondary-button.blade.php
│       │   └── text-input.blade.php
│       ├── dashboard.blade.php
│       ├── home.blade.php
│       ├── layouts/
│       │   ├── app.blade.php
│       │   ├── guest.blade.php
│       │   └── navigation.blade.php
│       ├── my-books.blade.php
│       ├── my-reservations.blade.php
│       ├── profile/
│       │   ├── edit.blade.php
│       │   └── partials/
│       │       ├── delete-user-form.blade.php
│       │       ├── update-password-form.blade.php
│       │       └── update-profile-information-form.blade.php
│       └── welcome.blade.php
├── routes/
│   ├── auth.php
│   ├── console.php
│   └── web.php
├── storage/
├── tailwind.config.js
├── tests/
└── vite.config.js


---

## 🎨 Design & UX
- Interactive hero section with badge and stats
- Floating cards for main features
- Responsive design for mobile, tablet, and desktop
- Animations: fade-in, floating elements, hover effects
- Color palette: eco-friendly 🌿 (yellow, green, white)

---

## ⚡ Installation & Running

### 1. Clone the project
```
git clone https://github.com/<your-username>/Ktebloop.git
cd Ktebloop
```
### 2. Install PHP dependencies
```
composer install
```
### 3. Configure environment
```
cp .env.example .env
php artisan key:generate
```
Edit .env to configure your database.
### 4. Run migrations
```
php artisan migrate
```
### 5. Start the server
```
php artisan serve
```

### 5. Start the server
Open http://127.0.0.1:8000 in your browser
