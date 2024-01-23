# Educational Portal

## Description

This web application serves as a comprehensive portal for an educational institution. It allows administrators to manage student and professor accounts, while providing students and professors with personalized access to relevant academic resources and information.

## Installation

### Prerequisites

- A web server
- PHP 
- MySQL (or another compatible database system)

### Setup

1. Clone this repository to your web server's document root.
2. Configure your web server to serve the `index.php` file as the default page.
3. Set up a MySQL database and import the provided SQL schema.
4. Modify the database configuration settings in the PHP files to match your setup.

## Usage

- **Home Page (`index.php`)**: The starting point of the web application.
- **Student Portal (`studentPage.php`)**: For students to access academic resources and information.
- **Professor Portal (`profPage.php`)**: Where professors can manage course details and student information.
- **Admin Section**: 
  - `admin.php`: Main administration dashboard.
  - `adminCreate.php`: For creating new student or professor accounts.
  - `adminEdit.php`: To edit existing accounts.
- **User Registration (`regUser.php`)**: New users can register here.
- **Logout (`logout.php`)**: For users to securely exit the application.

## Contributing

Contributions to this project are welcome. To contribute:

1. Fork this repository.
2. Create a new branch for your feature (`git checkout -b feature/AmazingFeature`).
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`).
4. Push to the branch (`git push origin feature/AmazingFeature`).
5. Open a pull request.
