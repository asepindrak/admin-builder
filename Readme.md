## Admin Dashboard Builder Framework v1

> As simple as you can (no coding needed!)

Author: Asep Indra K (https://asepindrak.github.io/)

URL: https://github.com/asepindrak/admin-builder

![alt text](https://repository-images.githubusercontent.com/623568846/f2f4fbda-8708-439b-97f8-10adf873fa07)

## Getting Started

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

Template Admin By

Template Name: NiceAdmin
Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
Author: BootstrapMade.com
License: https://bootstrapmade.com/license/
