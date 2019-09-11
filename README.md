# Address book

An address book app based on symfony framework.

## Technologies

---

- Symfony 3.4
- Doctrine with SQLite
- Twig
- PHP 7.0

## Set up using Docker

---

    1. Clone the project

    2. Only first time
        chmod +x ./build

    3. Run
        ./build

    4. Update your system host file (add symfony.local)

    ```bash
    # UNIX only: get containers IP address and update host (replace IP according to your configuration) (on Windows, edit C:\Windows\System32\drivers\etc\hosts)
    $ sudo echo $(docker network inspect bridge | grep Gateway | grep -o -E '([0-9]{1,3}\.){3}[0-9]{1,3}') "symfony.local" >> /etc/hosts
    ```
    5. visit symfony.local

## Set up without docker

---

`cd symfony`

start application :
`php bin/console server:run`
