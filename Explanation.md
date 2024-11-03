# Welcome to the Repository for the Cool Kids Network Theme

## Problem To Be Solved In My Own Words

I need to develop a website with Wordpress where users can register and get a character created for them, granting them access into their charcter dashboard where they can view all their character details. The game would use custom user roles to determine the level of access each user has to the platform. The roles would include: Guest or Anonymous User, Cool Kid, Cooler Kid, and Coolest Kid. The users with the role of Coolest Kid and Cooler Kid will have access to the Kids directory page to view a paginated list of other cool kids. However users with the role of "Cooler Kid" are unable to view the email address and role of other kids but they are still able to view the name and country of other kids. But users with the role of Cool Kid would only have access to their dashboard. And finally a maintainer would have the ability to update the role of any user through a third party integration with the help of a developed custom Rest API. The endpoint must be protected and only receives authenticated requests so that not just anyone can make changes to the user roles.

---

## Technical Specification of the Design

### Architecture** 
The project was built with a combination of Modular and Object-Oriented Programming with Dependency Injection. This awesome combination leverages principles of single responsibility and separation of concerns. This made each module encapsulated, easily reusable and maintainable.

###Theme (Cool Kids Network)
The theme follows Wordpress' Full Site Editing (FSE) standards, this allows users to really take advantage of block-based templating for user-facing content. Some of the modular components for specific functionalites include enqueueing assets, setting up theme support, and managing preconnect links.

### Plugin (Cool Kids Dashboard)
The dashboard plugin fully compliments the themes functionalities by providing a seamless functionality for the user dashboard and directory.
- A dedicated Plugin class registers and initializes services and dependencies, with core classes for block registration, role based redirects, user access management, and shortcode generation for the dashboard and kids directory. Each functionality is encapsulated in its respective class, this ensures easy maintenance and future scalability. That is good.
- Also Blocks are registered programmatically with custom render_callback functions for dynamic rendering, catering to the role-based and conditional logic required by the project.

### User Management and API Integration
- Uses email-only sign-in to simplify ease of access to the concept.
- An api call is made to the RandomUser API to generate additional user character details upon sign-up.
- Stores user country metadata, displayed on the admin dashboard, using custom metadata added during plugin activation.

### Role-Based Access Control and Conditional Routing
- RoleRedirect functionality restricts specific user roles ('Cool Kid,' 'Cooler Kid,' and 'Coolest Kid') from accessing the WordPress admin dashboard. Instead, they are redirected to a custom dashboard.
- Redirects and access control are properly managed by checking user roles and login status. For non-logged-in users, restricted pages are configured to redirect them to the homepage so they don't have access to the cool stuff.

### Frontend Display & Access Control
- Custom shortcodes were used for user dashboard and directory to enable a flexible frontend rendering solution. These shortcodes are added to the Dashboard and Directory pages automatically on plugin activation, this simplifies the setup for administrators.
- The login/logout block editor link, which dynamically adapts based on login status, provides intuitive navigation for end users.
- A custom block that displays a different content based on the user's logged in status was created. So they don't get confused about who we're talking to.


## How It Works

  - **User Registration & Character Creation:** Users can register with an email, which triggers character creation and fake identity generation. This is handle by the Cool Kids Dasboard plugin. 

  - **Role Management:**
    - "Cool Kid": These guys can only view their own character data.
    - "Cooler Kid": These guys can view other characters' data excluding emails and roles, implemented through role checks in a character data retrieval logic.
    - "Coolest Kid": They have full access to other characters data, including emails and roles.

  - **API Functionality:** 
  This provides an easy to use endpoint that allows dynamic role assignment through the `ChangeRole` class, enabling administrators and maintainers to manage user roles seamlessly.
    - How the API works:
      - The API endpoint is protected and only receives authenticated requests. Authentication method used is Basic Authentication, which requires the username of any administator and an application password for non-interactive systems.
      - Details for testing the API:
        - Username: Iversonweb
        - Password: RD3b jqnw HN0f GwOr kKVp lvgr
      - The endpoint is registered in the plugin's main file using the register_rest_route function.
      - The endpoint is secured using the rest_authentication_errors filter to ensure that only authenticated requests are processed.

  - **Custom Gutenberg Blocks:**
    - The theme fully Utilizes the @wordpress/block-editor library to create custom blocks like the authentication modal, the authentication toggler for the user role based content display block, and the header tools block for the login/logout button. This enhances user interaction within the WordPress block editor.


## Technical Decisions and Justifications

### Modular Object-Oriented Design and Dependency Injection
Why: This design architecture really enhances modularity and makes it easy to manage, debug and extend individual parts of the codebase and also promotes clear separation of concerns, properly seperating logic from data.
How: Dependency injection was also introduced to reduce tight coupling between classes.

### Role-Based Redirection and Shortcodes 
Why: For Dashboard Access and improving the overall user experience.

## Full Site Editing (FSE)
Why: To make use of the Wordpress modern block-based templating, which is the future of Wordpress and a modern practice. Also makes it easy fir non-developers to use. 

## Breaking Down Tasks Into Issues
Why: To keep track of the progress of the project and to make sure i don't miss out on any important parts of the project, making my work on the project more organized and easier to manage.


## How the Solution Meets the Admin’s Desired Outcome

The admin user story describes specific outcomes: simplified email-only sign-in and user registration, a custom user dashboard, role based access, and a custom REST API endpoint for role management. This solution meets these requirements effectively:

- **Simplified User Registration:** The email-only sign-in paired with the RandomUser API for user profile completion streamlines onboarding. The backend automatically generates user data (first name, last name, country), reducing friction during sign-up.

- **Custom User Dashboard:** By using shortcodes for the dashboard and directory, the solution allows quick setup of custom user pages.

- **Role-Based Access:** The solution presents a restriction to the data that each role can view on the kids directory page.

- **Frontend and Backend Consistency:** Making use of block-based Full Site Editing (FSE) elements and a page template (page.html) for dashboard and directory pages allows consistency between the backend and frontend, maintaining the custom theme’s look and feel across all user interactions.

- **Custom REST API Endpoint:** This solution makes use of a custom REST API endpoint for role management, which is protected and only receives authenticated requests. The api endpoint requires two combinations of data that can be used to pin point the user to update the role for. These combinations are the email and the role, and the first and last name of the user, with the specified role.


## Approaching and Thinking About the Problem

On seeing the user stories and project description, I was a bit overwhelmed at first. There were a lot of possible ways to go about the project. It didn't look like it was going to be a complex project, but i didn't take it lightly. I like handling projects beyond the technical side of things and think about how the next guy is going to find it easier to use. I set milestones for myself to work with and have a whole picture of the outcome in my head before i even start. Looking at the project and tasks that way helped me enjoy the process and loved the outcome. But i didn't loose focus on following best practices and maintaing code readability. Using modularity and object-oriented design gave me the freedom to be creative in the way I implemented logic and design choices. I get immense joy when people find it easy to use what i build, so i try to make it as customizable as possible.

