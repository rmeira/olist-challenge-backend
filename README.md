# Olist Challenge Backend

Projeto backend API para o desafio "Olist Challenge" leia mais sobre o desafio em [CHALLENGE](./CHALLENGE.md).

## Installation

Para rodar o projeto você precisa ter o Docker e o Docker Swarm(Cluster) iniciado em sua maquina, para isso siga os passos abaixo

The steps below are for the Ubuntu 20.04
```shell

# To install docker on linux ubuntu
curl -sSL https://get.docker.com/ | sh
sudo usermod -aG docker <you user>

# Reboot your pc

# Disabled IPV6
sudo vim /etc/sysctl.conf

# Add this lines on the end of the file sysctl.conf
net.ipv6.conf.all.disable_ipv6 = 1
net.ipv6.conf.default.disable_ipv6 = 1
net.ipv6.conf.lo.disable_ipv6 = 1

# For activate running the command bellow
sudo sysctl -p

# Now lets init docker swarm
docker swarm init

# For init the project running the command bellow
docker stack deploy --compose-file docker-compose.yml olist-challenge

# For stop the project
docker stack rm olist-challenge

```

Após instalar o docker e rodar o projeto com o comando `docker stack deploy --compose-file docker-compose.yml olist-challenge`, você precisa acessar o container no qual está rodando o projeto para rodar outro comando, para isso siga os passos abaixo:

```shell
# Execute o comando abaixo para listar os containers em execução
docker ps

# O retorno desse comando será parecido com isso:
# CONTAINER ID   IMAGE                                                       COMMAND                  CREATED       STATUS       PORTS                 NAMES
# b4a38e3208a5   rafaelmit/docker-php-8.0-local-laravel-development:latest   "/scripts/init.sh"       9 hours ago   Up 9 hours   80/tcp                olist-challenge_backend.1.nizo02r0c29kgvwyu0cyz0zmj
# 68c957050a06   mysql:5.7                                                   "docker-entrypoint.s…"   9 hours ago   Up 9 hours   3306/tcp, 33060/tcp   olist-challenge_mysql.1.h7dw1y5xfqdwa9zpzewutkdcg
# 40f53c8b6d30   mailhog/mailhog:latest                                      "MailHog"                9 hours ago   Up 9 hours   1025/tcp, 8025/tcp    olist-challenge_mailhog.1.stz2qvp6ojlxj0romu2lfe13y
# 21d2d1768808   redis:latest                                                "docker-entrypoint.s…"   9 hours ago   Up 9 hours   6379/tcp              olist-challenge_redis.1.wp7zaj5hdy7mra62gs5ic57da

# Agora veja o container que está rodando que tem o começo do nome "olist-challenge_backend" e copie o container id

# Agora execute o comando abaixo com com o container id
docker exec -it -u www-data <container-id> bash

# Com isso você vai estar acessando o container, agora vamos executar os seguintes comandos.

php artisan migrate --seed

# Agora para rodar os testes
php artisan test
```

## Acessos local

-   [Api](localhost)
    -   email: admin@olistchallenge.com.br
    -   password: password

## Libs

-   [laravel/laravel](https://laravel.com/)
-   [laravel/passport](https://github.com/laravel/passport)
-   [spatie/laravel-query-builder](https://github.com/spatie/laravel-query-builder)
-   [zircote/swagger-php](https://github.com/zircote/swagger-php)



