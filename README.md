<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Estudando Laravel

Aqui vão os passos que segui para criar um projeto Laravel para estudos, usando 2 computadores (1 Ubuntu e outro Windows com WSL2):

A ideia então seria simular um ambiente mais próximo do "mundo real" onde eu vou criar um novo projeto Laravel, e fazer upload/commit no GitHub, e depois baixar/clone o projeto em outro computador e executá-lo.

- Instalando Docker engine.
- Criando um projeto Laravel com Docker.
- Criando chave SSH para autenticação no GitHub.
- Criando este repositório aqui no GitHub e salvando o projeto.
- Baixando o projeto (clone) em outro computador.
- Executando o projeto em outro computador.
- Criar uma branch para adicionar nova feature ao projeto.
- Instalando Laravel/Breeze para autenticação de usuários.
- Enviando a nova feature do projeto ao GitHub.
- De volta ao computador 1.
- Rotas (e Middlewares).
- Criando uma Model de clientes.
- .
- .
- .

Objetivo Principal:
- Dominar Laravel.

Objetivos secundários:
- Criar pelo menos um CRUD usando Laravel+MySQL.
- Praticar Git e GitHub.
- Conhecer mais sobre Docker.
- (se possível ainda, criar testes unitários: PHPUnit ou Pest).
- (se possível ainda, fazer o deploy em um serviço de cloud).


# Instalando Docker engine.

Fonte:
- https://docs.docker.com/engine/install/ubuntu/#install-using-the-repository

Após instalado, ver a versão do docker:
- docker -v

Resultado esperado:
- Docker version 24.0.7, build afdd53b

Ver a versão do docker compose
- docker compose version

Resultado esperado:
- Docker Compose version v2.21.0

Fonte:
- https://docs.docker.com/engine/install/linux-postinstall/

Após instalar Docker engine, no Linux, rodar 2 comandos:
1) criar um grupo docker (avisou que grupo ja existia)
- sudo groupadd docker
2) adicionar o seu usuario ao grupo docker
- sudo usermod -aG docker $USER

Foi preciso reiniciar o computador, e para testar se deu certo rodar esse comando sem "sudo"
- docker run hello-world

Resultado esperado:
- Hello from Docker!

Outro exemplo de comando para testar listando os containers em execução:
- docker ps

# Criando um projeto Laravel com Docker.

O "Sail é uma abstração do Docker", criado para facilitar a execução de comandos no Docker.

Fonte:
- https://laravel.com/docs/10.x/installation#sail-on-linux

Rodei este comando
- curl -s https://laravel.build/laravel-example-app-01 | bash

Na primeira tentativa deu erro "Docker is not running", pois não tinha executado os 2 comandos citados após instalação do Docker engine.

Resultado esperado:
- Thank you! We hope you build something incredible.

Rodando a Aplicação com o comando "sail up" (parametro -d serve para não bloquear o terminal)
- ./vendor/bin/sail up -d

Abrir a aplicação no navegador
- http://localhost/ 

# Criando chave SSH para autenticação no GitHub.

Fonte:
- https://docs.github.com/en/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent

Criando uma chave SSH, e informar uma senha:
- ssh-keygen -t ed25519 -C "cybervoigt@gmail.com"

Resultado: será criada uma pasta .ssh contendo 2 arquivos:
- id_ed25519
- id_ed25519.pub

Comando para adicionar a chave criada ao "agente de autenticação":
- ssh-add ~/.ssh/id_ed25519

Informar a senha:
- Enter passphrase for /home/ricardo/.ssh/id_ed25519:

Resultado esperado:
- Identity added: /home/ricardo/.ssh/id_ed25519 (cybervoigt@gmail.com)

Comando cat para exibir a chave, que é o conteudo do arquivo
- cat ~/.ssh/id_ed25519.pub

Resultado esperado:
- ssh-ed25519 .................... cybervoigt@gmail.com

Acessar o GitHub, menu Settings, depois "SSH and GPG keys", e adicionar nova chave SSH colando o conteúdo retornado no comando acima.

Eu repeti esta etapa nos 2 computadores.

# Criando este repositório aqui no GitHub e salvando o projeto.

Acessar o GitHub, aba Repositories, botão New;

Informei o mesmo nome "laravel-example-app-01" da pasta

Após criar o repositório, clicar no botão SSH na caixa "Quick setup" e seguir as dicas de comandos listados abaixo:
<pre>
…or create a new repository on the command line
echo "# laravel-example-app-01" >> README.md
  git init
  git add README.md
  git commit -m "first commit"
  git branch -M main
  git remote add origin git@github.com:cybervoigt/laravel-example-app-01.git
  git push -u origin main
</pre>

Entrar na pasta do projeto:
- cd ~/laravel-example-app-01/

Comando para iniciar o repositorio local
- git init

Ao criar um projeto Laravel, ele já cria um arquivo README.md, que eu estou editando agora mesmo e gravando o passo a passo.

Testar status do repositório.
- git status

Os arquivos na cor vermelha não estão sendo monitorados pelo git.

Adicionar todos os arquivos da pasta
- git add .

Após adicionar os arquivos, ao rodar novamente o "git status", os arquivos devem aparecer na cor verde.

Antes de fazer o primeiro commit, deve configurar nome e email do autor/desenvolvedor
- git config --global user.email "cybervoigt@gmail.com"
- git config --global user.name "Ricardo Voigt"

Agora sim, commit com uma mensagem
- git commit -m "meu primeiro commit nesta pasta"

Definir branch main
- git branch -M main

Agora um comando bem importante, vamos relacionar a pasta local ao repositorio remoto
- git remote add origin git@github.com:cybervoigt/laravel-example-app-01.git

E por último, o comando que vai enviar/empurrar os arquivos locais para o repositório remoto
- git push -u origin main




# Baixando o projeto (clone) em outro computador.

Repetir o passoe descrito anteriormente para gerar outra chave SSH, com mesmo e-mail cadastrado no GitHub, para ter acesso ao repositorio.

Comando para baixar o repositório usando SSH:
- git clone git@github.com:cybervoigt/laravel-example-app-01.git

É possível clonar um repositório público sem SSH, mas entendi que precisa de chaves SSH para trabalhar com repositórios privados.

Se for necessário zerar tudo no computador local e começar denovo, este é comando para excluir a pasta do projeto:
- rm -rf laravel-example-app-01/
- Lembrar de commitar este arquivo README.md antes de excluir a pasta!

# Executando o projeto em outro computador.

A pasta "vendor" é onde o composer guarda as dependências, isto é, pacotes e bibliotecas de terceiros feitos em PHP que o projeto precisa para ser executado.

Ela não precisa ser enviada ao GitHub, por isso ela já se encontra na lista do arquivo .gitignore.

Duas opções para executar o composer:

## Opção 1 - executando composer com Docker

Será necessário criar um "shell script" para rodar o Docker passando alguns parâmetros.

Vou criar um arquivo "script_docker_run" baseado no exemplo do curso "Beed and code".

Código do arquivo "script_docker_run":
<pre>
#!/usr/bin/env bash
docker run --rm -i \
 -v $PWD:/app \
 -u $(id -u):$(id -g) \
 composer:2.4.2 "$@"
 </pre>

Resumindo, a primeira linha define que o arquivo é um "shell script", e o restante é o comando "docker run" com vários parâmetros.

Adicionar permissão de execução no arquivo
- chmod +x script_docker_run

Executando:
- ./script_docker_run composer install


## Opção 2 - executando composer diretamente no Linux

Instalando PHP+Composer diretamente no Linux.

Atualizando repositórios de pacotes do Linux:
- sudo apt-get update

Instalando PHP:
- sudo apt install php8.1-cli

Comandos para instalar o composer:
- php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
- php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
- php composer-setup.php
- php -r "unlink('composer-setup.php');"

Fonte:
- https://getcomposer.org/download/

Antes de rodar "composer update" precisei instalar mais uns pacotes
- sudo apt install php-curl
- sudo apt install php-xml
- sudo apt install zip unzip php-zip

Entrar na pasta do projeto
- cd ~/laravel-example-app-01/

Instalar os pacotes e dependências com composer:
 - composer install

## Rodar a aplicação

O arquivo "composer.lock" foi criado, e nele é gravada a versão instalada de cada pacote ou biblioteca de terceiros.

Criando/copiando arquivo .env a partir do .env.example
- cp .env.example .env

Veja que o campo APP_KEY está vazio dentro do arquivo .env

Comando para criar uma chave para a aplicação
1) opção 1 - com Docker
- ./script_docker_run php artisan key:generate
2) opção 2 - PHP direto no Linux
- php artisan key:generate

Rodar a aplicação
- ./vendor/bin/sail up -d

Abrir aplicação no navegador:
- http://localhost/

# Criar uma branch para adicionar nova feature ao projeto

Branch, como o próprio nome diz, é uma ramificação (galho) do projeto.
- https://git-scm.com/book/en/v2/Git-Branching-Basic-Branching-and-Merging

Pensei em criar uma branch pra registrar que eu vou adicionar uma nova feature ao projeto, no caso é o pacote Breeze do Laravel para autenticação de usuários.

Comando para listar:
- git branch

Criando uma Branch
- git branch feature/breeze

Definindo a Branch que vou trabalhar agora:
- git checkout feature/breeze

Ao listar novamente com o comando "git branch" devem aparecer 2 itens:
- * feature/breeze
-   main

# Instalando Laravel/Breeze para autenticação de usuários

Então, Breeze é um módulo/pacote pronto para autenticação de usuários em uma aplicação Laravel.

Fonte:
- https://laravel.com/docs/10.x/starter-kits#laravel-breeze


Rodar este comando para adicionar a dependência:
- ./vendor/bin/sail composer require laravel/breeze --dev

Depois rodar este comando para instalar o Breeze:
- ./vendor/bin/sail artisan breeze:install

Para esta instalação serão feitas algumas perguntas.
- faltou listar aqui... selecionei "Blade with Alpine".

Serão criados e alterados alguns arquivos que podem ser listados rodando "git status".

Na tela inicial da aplicação também devem aparecer 2 novos links:
- Log in (acessar o sistema)
- Register (criar um novo usuário)


## Percauços e tropeços com banco de dados MySQL e Docker

Ao rodar a aplicação e tentar incluir um usuário clicando no menu Register, deu erro de:
- SQLSTATE[HY000] [2002] Connection refused

Verifiquei que o container do MYSQL não está em execução. Provavelmente porque neste computador eu já tinha criado e rodado outros projetos de teste.
- docker ps

Os containers em execução também podem ser verificados no Docker Desktop, se tiver instalado.

Log de erros no Docker/Mysql
- docker logs id_do_container...

Achei esse erro:
- Cannot create redo log files because data files are corrupt or the database was not shut down cleanly after creating the data files.

Resolvido seguindo estas dicas, removendo a imagem e volume do mysql:
- docker images
- docker rmi mysql/mysql-server:8.0
- docker volume ls
- docker volume rm laravel-example-app-01_sail-mysql
- https://stackoverflow.com/questions/73217146/mysql-container-keep-not-connecting-to-my-container

Após rodar denovo a aplicação, ao clicar no menu Register e tentar criar um usuário, o erro continua:
- SQLSTATE[HY000] [2002] Connection refused

Acessando o Mysql por sail até funciona
- ./vendor/bin/sail mysql

Depois entrar no banco de dados
- use laravel_example_app_01;

Listando as tabelas:
- show tables;

Nada! Nenhuma tabela...

Uma sugestão que achei na internet seria trocar o DB_HOST de 127.0.0.1 para localhost, no arquivo .env, e após fazer isso e tentar rodar o comando migrate o erro do MYSQL mudou para:
- SQLSTATE[HY000] [2002] No such file or directory

## Solução para conectar no banco de dados

Então, neste exato momento eu não tenho acesso ao primeiro computador onde criei o projeto Laravel, pra ver as configurações no arquivo .env original.

Mas lembrei de ter visto em alguma video aula ou OLW do "Beer and code" sobre configurar o DB_HOST com "mysql" ao inves de "localhost" ou "127.0.0.1", pelo menos em ambiente de desenvolvimento quando o MySQL estiver rodando em outro container Docker.
- DB_HOST=mysql

Agora sim, vamos para o próximo passo.

## Próximo passo

Segundo a documentação do Breeze, após a instalação pede para rodar estes comandos abaixo:
- php artisan migrate
- npm install
- npm run dev


## Migrations

Então, o que são migrations?
- https://laravel.com/docs/10.x/migrations#introduction

Resumindo, Migrations é a forma criada para o framework controlar a estrutura e versão das tabelas no banco de dados.

Referente as tabelas relacionadas ao usuário para autenticação.

Este comando "php artisan migrate" vai executar os arquivos de migrations desta pasta:
- database/mgrations

Para conferir, basta acessar o MySQL:
- ./vendor/bin/sail mysql

Entrar no banco de dados:
- use laravel_example_app_01;

E listar as tabelas:
- show tables;

Serão criadas estas tabelas:
- failed_jobs
- password_reset_tokens
- personal_access_tokens
- users

## NPM

NPM é um gerenciador de pacotes de JavaScript, assim como o composer é para o PHP.

O Blade é o  "templating engine" do Laravel, e us a bilioteca Alpine (JavaScript), para fazer a parte visual (view) da aplicação.

Rodei os outros comandos usando o sail/docker:
- ./vendor/bin/sail npm install
- ./vendor/bin/sail npm run dev

Ao rodar o "npm run dev", foram atualizadas as dependências de bibliotecas de terceiros, no arquivo "package.json", mais ou menos como é feito com o arquivo "composer.json".

No arquivo package.json foram incluídos itens como:
- tailwindcss
- alpinejs

Agora sim, um novo usuário pode ser incluído usando o menu Register.





# Enviando nova feature do projeto ao GitHub

Então, ao enviar as alterações, com os seguintes passos:
- git status
- git add .
- git -m "new feature Breeze"
- git push

Retornou este erro:
<pre>
fatal: The current branch feature/breeze has no upstream branch.
To push the current branch and set the remote as upstream, use
 git push --set-upstream origin feature/breeze
</pre>

Resumindo, a branch chamada "feature/breeze" não existe no lado remoto, lá no GitHub.

Conforme sugerido, rodei este comando:
- git push --set-upstream origin feature/breeze

E agora lá no GitHub, ao acessar o repositório, abaixo do nome do repositório, deve aparecer
- 2 branches

Ao clicar em "2 branches" deve aparecer o nome do branch "feature/breeze" em "Your branches" e "Active branches", e ao lado um botão "New pull request".

É necessário criar uma "solicitação de pull" para que a nova feature seja efetivamente inserida no "codebase".

Se não der nenhum conflito de alterações em um mesmo arquivo, você poderá então confirmar fazendo o merge das alterações commitadas pela branch no repositório.

Aconteu aqui um conflito pois eu fiz commit do README.md tanto na branch main como na branch feature/breeze, revisei denovo todo o conteúdo nos pontos com conflito e commitei.

Agora, ao clicar novamente no link "2 branches", ao invés do botão "New pull request" deve aparecer escrito "Merged".

Fonte:
- https://docs.github.com/pt/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request


Após concluir o "Pull request", voltei pra branch main
- git checkout main

E rodei o comando pull pra ter certeza que o repositorio local estava atualizado
- git pull


# De volta ao computador 1

De volta ao computador 1, onde o projeto Laravel foi criado e feito o primeiro commit do projeto no GitHub, o objetivo agora será atualizar o projeto e fazer a aplicação rodar com tudo funcionando.

Primeiro comando a ser executado:
- git pull

Esse comando baixa/puxa todas as alterações realizadas no repositório remoto, e atualiza o repositório local com estas alterações.

Pra variar, eu tinha feito uma alteração neste README.md e não deixou fazer o pull.

Copiei o conteúdo do READM.md para o Notepadd++ e rodei este comando para desfazer as alterações e voltar a versão anterior do arquivo:
- git reset README.md

Agora sim o "git pull" funcionou.

Mas então, ao clicar em Login
- http://localhost/login

Vem o seguinte erro:
- Vite manifest not found

Ao lado na caixa verde a sugestão para corrigir o erro rodando este comando "npm run dev".

Como aqui não tinha o NPM instalado, rodei estes 2 comandos:
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev

Apenas pressionando F5 no navegador, não funcionou.

Fechei/Parei e rodei denovo a aplicação:
- ./vendo/bin/sail down
- ./vendo/bin/sail up -d

Ao tentar novamente o erro continua:
- Vite manifest not found

O comando que faltava era:
./vendor/bin/sail npm run build

Agora sim, vamos tentar criar um usuário:
- http://localhost/register

Desta vez o erro foi de que a tabela "users" não existe
- Base table or view not found...

Conforme descrito na caixa verde na direita, a solução é rodar as migrations:
- ./vendor/bin/sail php artisan migrate

Resultado esperado:
- You're logged in!

Neste momento os 2 computadores estão iguais, com o projeto rodando com o mesmo "codebase".


# Rotas (e Middlewares)

Na pasta "routes" tem diferentes arquivos para gerenciar as Rotas da aplicação, que na prática são os caminhos/URL que podem ser acessados no sistema.

Pelo que entendi então, não precisa mais ficar configurando rotas dentro de arquivo ".htaccess", o Laravel já faz esse trabalho.

Fonte:
- https://laravel.com/docs/10.x/routing

Por exemplo, ao inserir este código no arquivo web.php
<pre>
Route::get('/helloworld', function() {
    return "Hello World...";
});
</pre>

Agora é possível acessar esta URL:
- http://localhost/helloworld

Resultado esperado no navegador:
- Hello World...

Barbadinha... :-D

Outros exemplos podem ser verificados no arquivo "auth.php" que foi criado pelo módulo Breeze e contém as rotas "/login" e "/register", para um usuário acessar o sistema e se cadastrar no sistema, respectivamente.

Mais um pequeno exemplo, vou criar uma rota, olhando o exemplo "/dashboard", no arquivo "web.php" onde é verificado se o usuário está logado no sistema.

<pre>
Route::get('/hellouser', function() {
    return "Hello User: ". auth()->user()->name;
})->middleware(['auth', 'verified'])->name('hellouser');
</pre>

Ao acessar este caminho:
- http://localhost/hellouser

Caso o usuário não esteja logado, será redirecionado automaticamente para a tela de Login atraves de um "middleware".

Após acessar o sistema com e-mail e senha, ele será redirecionado de volta ao "/hellouser" e deve aparecer então a seguinte mensagem:
- Hello User: nome do usuário


## Middlewares

Um "middleware" é como um filtro, que faz testes e redirecionamentos.
- https://laravel.com/docs/10.x/middleware

Resumindo, os parâmetros ['auth','verified'] passados na rota "hellouser" são apelidos(aliases) para os middlewares "Authenticate" e "EnsureEmailIsVerified" definidos no arquivo:
- app/Http/Kernel.php




# Criando Models de Atividades e Clientes

O que é uma Model ?
- https://laravel.com/docs/10.x/eloquent#introduction

Resumindo:
- uma Model é uma classe que representa uma tabela em um banco de dados.
- E cada objeto criado a partir dessa classe representa uma linha na respectiva tabela.

O Laravel tem um módulo chamado Eloquent, um Object-Relational Mapper (ORM) que é responsável por fazer esta tarefa de Mapeamento Objeto-Relacional. Isso mesmo, esse foi o assunto do meu TCC (trabalho de conclusão de curso) em 2006.


Ideia inicial com apenas 2 tabelas:
- tabela de Ramos/Tipos de Atividades (Activities)
- tabela de Clientes (Customers)

Nomes das tabelas em inglês: Activities e Customers.

Cada Cliente será associado a um Ramo de Atividade.

Exemplos (Seeds) de Ramos de Atividades:
- Construtora
- Revenda de Carros
- Supermercado
- Material de construção
- Material elétrico

## Criando Model de Atividades

Rodar o comando "artisan" para criar a Model:
- ./vendor/bin/sail artisan make:model Activity -ms

Junto com a criação do arquivo da classe Model:
- o parâmetro -m também cria o arquivo de Migration
- o parâmetro -s também cria o arquivo de Seeds

Resultado esperado:
- Model [app/Models/Activity.php] created successfully.  
- Migration [database/migrations/2023_12_09_221359_create_activities_table.php] created successfully.  
- Seeder [database/seeders/ActivitySeeder.php] created successfully.

Essa brincadeira tá começando a ficar legal...

## Migration

No arquivo "2023_12_09_221359_create_activities_table.php", vou definir a estrutura da tabela adicionando estas linhas na function "up":
- $table->string('name', 100);
- $table->string('description')->nullable();

Serão criadas 2 colunas para guardar texto/string na tabela: name e description. Veja que eu defini o tamanho máximo de 100 caracteres para "name" e também defini que a coluna "description" pode ficar vazia, isto é, aceita NULL.

## Model

Nesta classe "Activity" será necessário informar a variável $fillable:
<pre>
protected $fillable = [
    'name',
    'description'
];
</pre>

## Seeder

Já o arquivo "ActivitySeeder.php" vamos programar a inserção de registros na tabela apenas com objetivo de testes.

Fonte:
- https://laravel.com/docs/10.x/seeding

## Rodando Migration + Seeder

O primeiro passo então é rodar a migration para criar a tabela no banco de dado:
- ./vendor/bin/sail php artisan migrate

E agora rodar o comando para executar o Seeder
- ./vendor/bin/sail php artisan db:seed



<hr>
to be continued...
