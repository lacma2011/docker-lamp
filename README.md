# docker-lamp
Docker example with Apache, MySql 5.7, PhpMyAdmin and PHP 7.3.

```

Workspace container runs PHP 7.2, git, composer, and other tools needed for development.


## connecting to mysql from workspace

`mysql myDb -h db -u user -p`

## optimize mysql

mysql data should be in a seperate partition than the host OS because this partition should have this flag: barrier=0. Otherwise, writes will take 5-10x longer and this will be obvious when running phpunit tests
