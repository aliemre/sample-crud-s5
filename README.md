# Project Details

This project is simple CRUD application for Products. It contains related models:

  - Category (Many-to-One)
  - SubCategory (Many-to-One)
  - Tag (Many-to-Many)
  - Image (One-to-Many)
  - Brand (Many-to-One)

# Dependencies

- vich/uploader-bundle
- knplabs/knp-gaufrette-bundle

# Run Project

 To run the project, please follow the steps after git clone / download:
 
 Install dependencies:
 `$ composer install`
 
 Update DB configuration on **.env.local** and Create database:
 `$ ./bin/console doctrine:create:database` 
 
 Run on localhost:
 `$ symfony:serve`
