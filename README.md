# Technical Test Backend - Sekawan Media

## System Requirements

- Web Server : -
- PHP : v8.1.8
- Node : v16.16.0
- MySQL : v8.1.0
- BE Framework : Laravel v10
- FE Framework : Svelte v4.0.5
- Web Browser : Chrome

## Get Started

1. Clone github repository `git clone https://github.com/ahmadaait/sekawan-technical-test.git`
2. Setup backend go to directory `cd backend`
3. Install dependency backend with `composer install`
4. Setup .env
5. Generate App key `php artisan key:generate`
6. Generate JWT secret key `php artisan jwt:secret`
7. Migrating database `php artisan migrate`
8. Seeding database `php artisan db:seed`
9. Running backend using `php artisan serve`
10. Setup frontend go to directory `cd frontend`
11. Install dependency frontend with `npm install` or `yarn install`
12. Setup .env
13. Running frontend using `npm run dev`

## User Account

1. **Admin** (email: admin@gmail.com | password: test123)
2. **Branch Office** (email: branch@gmail.com | password: test123)
3. **Head Office** (email: head@gmail.com | password: test123)
