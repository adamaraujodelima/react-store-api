# API - CONVFORN - Integração de empresas e fornecedores

## Escopo
Aplicação rodando em container Docker em Laravel Framework, cache via Redis, Mysql e MailDev para testar e-mails com objetivo de demonstrar exemplo de Blog Simples em Laravel. 

## Requisitos

Docker (https://www.docker.com/) + docker-compose (https://docs.docker.com/compose/) instalado e configurado para rodar o container.

## Como instalar?

- Clone a aplicação para seu diretório: git clone https://github.com/adamaraujodelima/laravel-blog-docker-redis.git
- Acesse a pasta criada e execute  o arquivo run.sh via terminal: ./run.sh
- Aguarde a inicialização do container Docker e a instalação e configuração da aplicação em Laravel
- Após finalizado, acesse http://localhost para ver a aplicação rodando.
- Obs: Caso esteja rodando algum serviço nas portas 80, 1080, 1025 e 3306, você deverá parar estes serviços para que o container do Docker possa inicializar e rodar corretamente.

# Como Testar?

## Usuário

- Acesse http://localhost

- Crie uma conta de usuário para poder publicar posts

- Ao criar a conta, um e-mail de verificação será enviado com um link de confirmação de conta. Acesse http://localhost:1080 para acessar o emulador de caixa postal e confirmar o e-mail.

- Após confirmar o e-mail, você será redirecionado para a listagem dos seus posts. Para adicionar um POST, clique no menu superior a esquerda em "+ PUBLICAR UM POST".

- Para editar um Post, acesse o menu superior "MEUS POSTS", localize o POST desejado e clique em EDITAR nos detalhes do POST ou na HOME na listagem de POST, localize o POST e clique em editar. A opção de "EDITAR" somente estará disponível se estiver logado em sua conta.

- Para excluir um POST, acesse a HOME ou MEUS POSTS e clique na opção "EXCLUIR" do POST desejado.


## Administrador

- Para acessar como administrador, utilize a url http://localhost/admin
- Um usuário padrão será adicionado na finalização de instalação da aplicação via Docker. Sendo assim, utilize o e-mail "admin.laravel.blog@gmail.com" e senha "123456" para acessar como administrador pela primeira vez.
- No menu POSTS poderá ver todos os POSTS cadastrados bem como editar os mesmos ou excluí-los
- No menu USUÁRIOS poderá cadastrar usúario do tipo ADMINISTRADOR ou USUÁRIO padrão bem como alterar ou excluir se desejar.

        

