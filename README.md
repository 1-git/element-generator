File directories
========================

*files/input* - folder for input files

*files/output* - folder with generated files

Fast execution with one command:
==========
**Important!** Before running the command, place your file into the folder *files/input* (because of using docker
container).

To execute everything in a single command, the following command should be used:

```
make
```

This command executes subcommands from the *Makefile*.

Execution step by step with command description (using docker):
==========

1. Container initiation:

```
docker-compose build
docker-compose run app composer install
```

2. Get command description:

```
docker-compose run app php ./application.php -h
```

3. Place your file into the folder *files/input*.

4. File generation:

```
docker-compose run app php ./application.php
```

or

```
docker-compose run app php ./application.php input.csv
```

or

```
docker-compose run app php ./application.php input.csv output.json
```

5. Run unit tests:

```
docker-compose run app php ./vendor/bin/phpunit
```
