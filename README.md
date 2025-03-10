# OTP Verification System
## Installation
1. Setting up, make sure that your local machine has PHP, Composer, Mysql installed. In addition, you should either install Node and npm or Bun. For easy setup install lando. Look at the [Lando documentation](https://docs.lando.dev/getting-started) to learn more.
 ```
  $ lando composer install
  ```
2. Configure and run migration, copy .env.example and make necessary changes based on your local development.
 ```
  $ cp .env.example .env
  ```
## Testing
1. Test using seed account admin@example.com password: password
```
  $ lando php artisan migrate
  $ lando php artisan db:seed
```

## Assumptions

1. User Authentication System Exists

Laravel's built-in authentication (auth(), Auth::check()) is available.
Users must register and log in before accessing the job posting feature.
2. JobsBoard Model Has a user_id Column

Each job post must be linked to a registered user (user_id).
A migration has been created to add user_id to the jobs_board table.
3. Authorization Middleware is Applied

The /job/create route is protected with auth middleware.
Non-logged-in users can access the job posting page.
4. Users Can Post Jobs but Require Moderator Approval

Job posts are not published immediately (status = pending).
A moderator must approve (status = published) before jobs appear publicly.

## Technical Decisions

1. Authentication & Authorization
Decision: Use Laravel's built-in authentication (auth() & middleware)

* Secure and well-integrated with Laravel UI, Breeze, or Jetstream.
* Allows easy role-based access control (RBAC) for moderators.
* Prevents non-logged-in users from accessing the job posting page.

2. Job Posting with Livewire
Decision: Use Livewire Volt for real-time job form submission

* Simplifies form handling & validation.
* Provides instant feedback to users.
* Works seamlessly with Laravel backend.

3. Data Model & Database Design
Decision: Extend the JobsBoard model to store user information

* Tracks job ownership (user_id).
* Allows future features (e.g., user job history).
* Ensures only logged-in users can create jobs.

4. Moderation System
Decision: Allow jobs to be posted immediately but require approval

* Ensures quality control before jobs are visible.
* Gives moderators control over spam or fake jobs.
* Uses a status column instead of a separate table.

5. UI & UX Considerations
Decision: Improve user experience with flash messages & real-time updates

* Gives users feedback after posting a job.
* Ensures smooth form handling.