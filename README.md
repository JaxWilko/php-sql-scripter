# php-sql-scripter

The purpose of this project is to provide the ability to generate portable php files which can be ran in any enviroment to migrate database changes.

## To install

```
git clone git@github.com:JaxWilko/php-sql-scripter.git

cd php-sql-scripter

mv config.example.php config.php
```

Next fill in your `config.php` file with the connection details of the database.

Once this is done you're ready to start using the scripter.

```
./app --new file-name
```

This will create a new template file with the name provided in the transactions directory, go ahead and modify this to meet your requirements.

To execute your script:

```
./app --run file-name
```

This will open an interactive script asking you to confirm each statement before execution.
