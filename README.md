# Snall php Course tasks
## Week_tsk_1 
This is learning the basics of php, functions, types, etc.
## Week_tsk_2
Small apps to:
* Study some functions 
* Sql + php interaction
* Classes 
## Week_tsk_3
Small core PHP app - forum
###Structure:
* Autoloader is used to connect files
* Typical MCV models,controllers,and views are in the app folder
* The DB and routing classes, as well as application, lie in src
* To access the blog, follow the link http://localhost/blog *authorization is required
### Migrations
* In the file migrations.php database scripts (dump) are called (multiquery)
### Images
* Only the path to the image is stored in the database
* Unique names are generated for each image
## Week_tsk_4
Small core PHP app forum, but with some libraries:
```
{
  "require": {
    "swiftmailer/swiftmailer":"^6.0",
    "twig/twig": "^3.0",
    "intervention/image":"dev-master"
  },
  "autoload": {
    "psr-4": {"App\\": "app/", "Core\\": "src/"}
  }
}
```
## Week_tsk_5
Small core PHP app forum, but now with ORM Eloquent 
```
{
  "require": {
    "swiftmailer/swiftmailer":"^6.0",
    "twig/twig": "^3.0",
    "intervention/image":"dev-master",
    "illuminate/database": "^9.30"
  },
  "autoload": {
    "psr-4": {"App\\": "app/", "Core\\": "src/"}
  }
}
```
## Week_tsk_5
Shop is Laravel app
