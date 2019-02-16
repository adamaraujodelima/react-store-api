# Laravel API for store in ReactJS

## Escopo
Aplicação rodando em container Docker em Laravel Framework, cache via Redis, Mysql e MailDev para testar e-mails com objetivo para ser uma API consumida por aplicação em modelo e-commerce desenvolvida em ReactJS. 

## Requisitos

Docker (https://www.docker.com/) + docker-compose (https://docs.docker.com/compose/) instalado e configurado para rodar o container.

## Como instalar?

- Clone a aplicação para seu diretório: git clone https://github.com/adamaraujodelima/react-store-api.git
- Acesse a pasta criada e execute  o arquivo run.sh via terminal: ./run.sh
- Aguarde a inicialização do container Docker e a instalação e configuração da aplicação em Laravel
- Após finalizado, acesse http://localhost para ver a aplicação rodando.
- Obs: Caso esteja rodando algum serviço nas portas 80, 1080, 1025 e 3306, você deverá parar estes serviços para que o container do Docker possa inicializar e rodar corretamente.

# Especificações

- Laravel 5.7
- Laravel Passport
- Mysql 5.7.22
- Redis Server 4.0.5
- PHP FPM
- NGINX

        

