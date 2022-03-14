# Webtop_POC
This is a POC to create Fedora desktop using a web application and access through browser

**Prerequisite**
- Docker
- PHP
- MySql
- WAMPServer

**MySQL**
Please run the Webtop_DB_objects file in MySQL to create the DB and table objects.

**PHP**
Please configure your Machine IP and credentials in the PHP file /POC/db.php

**Docker**
Please run the attached docker compose file to create docker image.

**Running Procedure**
- Please use the web page registration.php to add user and their crediental
- End users can login through login.php using the above created credentials.
- They can mention the memory and CPU required in the next page and clicking on "Create" will create the virtual machine. Users can find the list of port numbers to be used to access their machines.  
