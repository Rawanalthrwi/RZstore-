# Website Project

### Tech Stack
- PHP 
- MySQL
- HTML / CSS / JavaScript

## Steps to set up application
1. Create a database called <strong><code>websiteproject_database</code></strong> <br /><small>(or alternatively update name <strong><code>DB_NAME</code></strong> value in <code>config/database.php</code>)</small>, 
2. import <code>config/seed/products.sql</code> and <code>config/seed/orders.sql</code> to the newly created database.
3. Update database settings in <code>config/seed/products.sql</code> to your own.
4. On a running server, launch <code>index.php</code> in the browser.


## Database connection
The following settings, defined in <code>config/database.php</code>, are used to connect to the database:

<pre><code>define("DB_HOST", "localhost");
define("DB_NAME", "websiteproject_database");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "root");</code></pre>
