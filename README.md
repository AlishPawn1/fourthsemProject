# Newari Traditional Dress & Ornaments E-Commerce

A PHP-based e-commerce platform for selling traditional Newari dresses, ornaments, and accessories. The project features a user-friendly shopping experience, robust admin management, and supports multiple payment gateways (Stripe, Khalti, and Cash on Delivery).

---

## Features

### User Features
- **Product Browsing:**
  - View all products, filter by category or tag, and search for items.
  - Detailed product pages with images and descriptions.
- **Cart & Checkout:**
  - Add products to cart, view cart, and proceed to checkout.
  - Place orders and choose payment method (Cash on Delivery, Stripe, Khalti).
- **User Account:**
  - Registration with email verification (via PHPMailer).
  - Login, profile management, password reset, and account deletion.
  - View order history and order status.
- **Payments:**
  - Stripe integration for card payments.
  - Khalti integration for digital wallet payments (Nepal).
- **Contact & Feedback:**
  - Contact form with email delivery (PHPMailer).
  - Feedback system for users to send messages to admin.

### Admin Features
- **Dashboard:**
  - Secure login and registration with email verification.
  - View site statistics and quick links.
- **Product Management:**
  - Add, edit, delete, and view products.
  - Manage product categories and tags.
  - Upload product images.
  - Stock management and history tracking.
- **Order & Payment Management:**
  - View, complete, or delete orders.
  - View all payments and user details.
- **Reports:**
  - Product sales and inventory reports.
- **Feedback:**
  - View user feedback and contact messages.

---

## Tech Stack
- **Backend:** PHP 7/8, MySQL (MariaDB)
- **Frontend:** HTML5, CSS3, Bootstrap 5, jQuery, Splide.js (slider), Fancybox (gallery)
- **Email:** PHPMailer
- **Payments:** Stripe, Khalti

---

## Project Structure

```
/ (root)
├── admin_area/         # Admin dashboard, product/order/user management
│   ├── product_images/ # Uploaded product images
│   ├── ...             # Admin PHP files (dashboard, CRUD, reports, etc.)
├── user_area/          # User account, checkout, payment, profile
│   ├── user_image/     # Uploaded user profile images
│   ├── ...             # User PHP files (registration, login, orders, etc.)
├── css/                # Stylesheets (Bootstrap, custom, animations)
├── js/                 # JavaScript (Bootstrap, jQuery, Splide, Fancybox, custom)
├── fonts/              # Font files (FontAwesome, Slick, etc.)
├── image/              # Site images (banners, logos, etc.)
├── function/           # Common PHP functions (product display, cart, etc.)
├── include/            # Database connection and setup scripts
├── vendor/             # Composer dependencies (PHPMailer, Stripe, etc.)
├── PHPMailer-master/   # PHPMailer library (if not using Composer)
├── shop.sql            # Database schema and sample data
├── index.php           # Main landing page
├── display_all.php     # All products listing
├── cart.php            # Shopping cart
├── category.php        # Category view
├── tag.php             # Tag view
├── search.php          # Search results
├── contact.php         # Contact form
├── policy.php          # Privacy policy
├── 404.php             # Custom error page
└── ...
```

---

## Setup Instructions

### Prerequisites
- PHP 7.4+
- MySQL/MariaDB
- Composer (for dependency management)
- Web server (Apache recommended)

### Installation
1. **Clone the repository:**
   ```bash
   git clone <repo-url>
   cd fourthsemProject
   ```
2. **Install dependencies:**
   ```bash
   composer install
   ```
   (If not using Composer, ensure `PHPMailer` and `Stripe` libraries are present in `vendor/` or `PHPMailer-master/`.)
3. **Database setup:**
   - Create a database named `shop`.
   - Import the schema and sample data:
     ```bash
     mysql -u root -p shop < shop.sql
     ```
   - Or use `include/create_database.php` and `include/connect_database.php` for setup.
4. **Configure database connection:**
   - Edit `include/connect_database.php` with your DB credentials if needed.
5. **Configure email (PHPMailer):**
   - Update SMTP credentials in user/admin registration and contact files.
6. **Configure payment gateways:**
   - Update Stripe and Khalti API keys in `user_area/stripe_payment.php` and `user_area/khalti_payment.php`.
7. **Set up web server:**
   - Point your web server root to the project directory.
   - Ensure `mod_rewrite` is enabled for clean URLs (optional).

---

## Usage
- **Homepage:** Browse featured products, categories, and new arrivals.
- **Shop:** View all products, filter by category/tag, search, and add to cart.
- **Cart & Checkout:** Review cart, proceed to checkout, and select payment method.
- **User Account:** Register, verify email, login, manage profile, view orders.
- **Admin Area:** `/admin_area/` for product, order, user, and report management.

---

## Security Notes
- Passwords are stored as plain text in the current code. **Change to password hashing (e.g., `password_hash`) for production.**
- Update all hardcoded credentials (SMTP, Stripe, Khalti) before deploying.
- Validate and sanitize all user inputs to prevent SQL injection and XSS.

---

## License
This project is for educational purposes. See individual library licenses for third-party dependencies.

---

## Credits
- [PHPMailer](https://github.com/PHPMailer/PHPMailer)
- [Stripe PHP](https://github.com/stripe/stripe-php)
- [Bootstrap](https://getbootstrap.com/)
- [Splide.js](https://splidejs.com/)
- [Fancybox](https://fancyapps.com/fancybox/3/)

---

## Screenshots
_Add screenshots of the homepage, product page, cart, checkout, and admin dashboard here._ 