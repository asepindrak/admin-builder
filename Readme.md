## Admin Dashboard Builder Framework v1.0.11

> As simple as you can (no coding needed!)

Author: Asep Indra K (https://asepindrak.github.io/)

URL: https://github.com/asepindrak/admin-builder

![alt text](https://repository-images.githubusercontent.com/623568846/f2f4fbda-8708-439b-97f8-10adf873fa07)

## Getting Started

- Supported web server: Apache2
- Supported web server: Nginx (convert .htaccess to nginx configuration: https://winginx.com/en/htaccess)
- Supported database: Mysql (Install WAMP for windows or LAMP STACK on Linux)
- XAMPP is not supported because it uses MariaDB which doesn't have JSON_ARRAYAGG & JSON_OBJECT functions

1. Configuration

   - create new file config/config.php or duplicate from config.sample.php
   - change variable $SERVER to your host
   - create new file api/v1/config/db.php or duplicate from api/v1/config/db.sample.php
   - create new database

2. Models

   - create new model file at api/v1/models/
   - add new model to api/v1/models/models.php

3. Pages & Routing

   - add new page to config/pages.php

4. Tables

   - create new table file at tables/
   - add new table to tables/tables.php

5. Migrations

   - access /api/v1/config/generate_db.php from your browser

6. Login
   - default access (username: admin, password: admin)

##Example

> Model

### model articles

```
$models['articles'] = array(
   'title' => 'text', //type text
   'category_id' => array( // foreign key for table article_categories id
      'model' => 'article_categories', //table article_categories
      'type' => 'int(11)', // type int with length 11
      'isNull' => true // set NULL
   ),
   'slug' => 'text', //tyoe text
   'content' => 'text', //tyoe text
   'keyword' => 'text', //tyoe text
   'publish_date' => 'date', //tyoe date
   'image' => 'text' //tyoe text
);

```

### model article_categories

```
$models['article_categories'] = array(
   'name' => 'varchar 50 null', // type varchar, length 50, default value null
);
```

### model users

```
$models['users'] = array(
   'username' => 'varchar 50 null', // type varchar, length 50, default value null
   'email' => 'varchar 60 null', // type varchar, length 60, default value null
   'password' => 'varchar 100 null', // type varchar, length 100, default value null
   'image' => 'text', // type text
   'name' => 'varchar 50 null', // type varchar, length 50, default value null
   'phone' => 'varchar 15 null', // type varchar, length 15, default value null
);
```

Template Admin By

Template Name: NiceAdmin
Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
Author: BootstrapMade.com
License: https://bootstrapmade.com/license/

```

```
