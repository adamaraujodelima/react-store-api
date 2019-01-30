#!/bin/bash

echo "Inicializando container Docker" 
docker-compose up -d

echo "Copiando arquivo de configuração do Laravel"
docker exec -it app cp .env.example .env

echo "Instalando dependências"
docker exec -it app composer install

echo "Gerando chave"
docker exec -it app php artisan key:generate

echo "Rodando o migrate"
docker exec -it app php artisan migrate

echo "Configurando API Authentication (Passport)"
docker exec -it app php artisan passport:install

echo "Comandos para as configurações extras"
docker exec -it app php artisan storage:link
docker exec -it app php artisan db:seed

echo "Instalação finalizada. Acesse http://localhost para acessar a aplicação."
#docker ps -a 