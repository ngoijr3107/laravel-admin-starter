# Laravel Admin Template

## Install steps

```bash
# 1. Clone this repository
git clone https://github.com/ngoijr/laravel-admin-starter
cd laravel-admin-starter

# 2. cp .env.example .env

# 3. Set up your database in .env, then run migrations
#    (the default users/password_reset_tokens/sessions tables are all you need)
php artisan migrate

# 4. Serve it
php artisan serve
```

Visit `/register` to create the first account, or `/login` if you already
have a user in the database.

## What's included

```
app/Http/Controllers/DashboardController.php          Dashboard, Tables, Components
app/Http/Controllers/Auth/AuthenticatedSessionController.php   Login / logout
app/Http/Controllers/Auth/RegisteredUserController.php         Registration
app/Http/Controllers/Auth/PasswordResetLinkController.php      Forgot password
app/Models/User.php                                    Standard Laravel user model

resources/views/layouts/app.blade.php     Master layout (sidebar + topnav + content)
resources/views/layouts/auth.blade.php    Auth layout (split-screen brand panel)
resources/views/partials/sidebar.blade.php
resources/views/partials/topnav.blade.php
resources/views/dashboard.blade.php       Stat cards, charts, orders table, activity feed
resources/views/tables.blade.php          Data tables page
resources/views/components.blade.php      UI component kit
resources/views/auth/login.blade.php
resources/views/auth/register.blade.php
resources/views/auth/forgot-password.blade.php

public/css/app.css     Shared design system (dashboard/tables/components pages)
public/js/app.js       Shared shell JS (theme engine, sidebar, fullscreen, submenus)
public/css/auth.css    Auth page styles
routes/web.php          All named routes
```

## Notes

- **Theme, sidebar, and fullscreen controls** live in `public/js/app.js` and are
  shared across every page via the master layout — edit once, applies everywhere.
- **Charts** (`Chart.js`) are only loaded on the dashboard page via `@push('vendor-scripts')`,
  so other pages don't pay for a script they don't use.
- **Auth is wired to real Laravel**, not just demo JS: login uses `Auth::attempt()`,
  registration hashes passwords with `Hash::make()`, and "forgot password" uses
  Laravel's built-in `Password::sendResetLink()` broker. You'll need mail configured
  in `.env` for reset emails to actually send.
- The sidebar's "Data Views" submenu auto-expands when you're on `/tables`, driven
  server-side via `request()->routeIs()` in the Blade partial — no JS needed for that.
- All CDN links (Bootstrap, Bootstrap Icons, Chart.js, Google Fonts) point at
  `cdnjs.cloudflare.com`, which is reliable and fast; swap for local `npm`/Vite
  assets later if you want an offline build.
