## Shipsoftware-php

Web version of Shipsoftware

### Setup

Notes for configuration.

#### Prerequisite

- SQL Database created with [SQL clause's](https://github.com/Shipsoftware-schoolproject/shipsoftware-sql/tree/master/MySQL)

#### .env -file

.env file is not tracked in by version control and thus it needs to be manually
created. Below is listed only crucial parameters to your development going:

`APP_ENV=local` - Set's application environment to `local`  
`APP_DEBUG=true` - Enables debugging

`DB_DATABASE="db_name"` - Name of the database  
`DB_USERNAME="db_username"` - Database username  
`DB_PASSWORD="db_password"` - Password of database user
