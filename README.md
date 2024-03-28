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
- Criando Models de Atividades e Clientes.
- Criando uma Rota para listar Atividades.
- Criando uma View com Blade.
- Criando uma classe Controller.
- Requisções HTTP.
- Usando o programa Insomnia
- Usando Collections (ao inves de Arrays).
- Fazendo consultas na tabela de Atividades.
- Validando dados de uma Requisição.
- Criando um formulário com Blade
- Métodos "create" e "store" do Controller
- Criando um FormRequest
- .
- Criando uma Policy.
- Criando uma Query Scope.
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

Erro : Could not open a connection to your authentication agent.

Se ocorrer esse erro, deve executar o "agente de autenticação" com este comando
- eval `ssh-agent -s`


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

## Arquivo de configurações .env

Criando/copiando arquivo .env a partir do .env.example
- cp .env.example .env

Fonte:
- https://laravel.com/docs/10.x/configuration#environment-configuration

Veja que o campo APP_KEY está vazio dentro do arquivo .env

Comando para criar uma chave para a aplicação
1) opção 1 - com Docker
- ./script_docker_run php artisan key:generate
2) opção 2 - PHP direto no Linux
- php artisan key:generate

## Obs 

Depois de fazer alterações no arquivo .env devem ser executados estes 2 comandos:
- php artisan config:clear
- php artisan env

## Rodar a aplicação

O arquivo "composer.lock" foi criado, e nele é gravada a versão instalada de cada pacote ou biblioteca de terceiros.

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

O Blade é um "templating engine" do Laravel, e usa a bilioteca Alpine (JavaScript), para fazer a parte visual (View) da aplicação.

Rodei os outros comandos usando o sail/docker:
- ./vendor/bin/sail npm install
- ./vendor/bin/sail npm run dev

Ao rodar o "npm run dev", foram atualizadas as dependências de bibliotecas de terceiros, no arquivo "package.json", mais ou menos como é feito com o arquivo "composer.json".

No arquivo package.json foram incluídos itens como:
- tailwindcss
- alpinejs

Agora sim, um novo usuário pode ser incluído usando o menu Register.



# Enviando nova feature do projeto ao GitHub

Então, enviar as alterações com os seguintes comandos:
- git status
- git add .
- git commit -m "new feature Breeze"
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

Resumindo, Vite (https://vitejs.dev/) é uma ferramenta que empacota os arquivos CSS e Javascript (bundling assets) para o deploy da aplicação.
Fonte:
- https://laravel.com/docs/10.x/frontend#bundling-assets
- https://laravel.com/docs/10.x/vite#introduction


Ao lado na caixa verde a sugestão para corrigir o erro rodando este comando "npm run dev".

Como aqui não tinha o NPM instalado, rodei estes 2 comandos:
- ./vendor/bin/sail npm install
- ./vendor/bin/sail npm run dev

Apenas pressionando F5 no navegador, não funcionou.

Fechei/Parei e rodei denovo a aplicação:
- ./vendo/bin/sail down
- ./vendo/bin/sail up -d

Ao tentar novamente o erro continua:
- Vite manifest not found

O comando que faltava era:
- ./vendor/bin/sail npm run build

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

Uma dica é que se a rota vai retornar conteúdo HTML use o "web.php", mas se a rota retornar conteúdo JSON use o arquivo "api.php".

Fonte:
- https://laravel.com/docs/10.x/routing

Por exemplo, para criar uma rota que responde a requisições HTTP com GET, basta inserir este código no arquivo "web.php":
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

Comando para listar as rotas disponiveis na aplicação:
- ./vendor/bin/sail php artisan route:list

## Middlewares

Um "middleware" é como um filtro, que faz testes e redirecionamentos.
- https://laravel.com/docs/10.x/middleware

Resumindo, os parâmetros ['auth','verified'] passados na rota "hellouser" são apelidos(aliases) para os middlewares "Authenticate" e "EnsureEmailIsVerified" definidos no arquivo:
- app/Http/Kernel.php

## Criando uma Branch apenas para commitar este teste de Rota

Criando uma Branch
- git branch testing/routes

Definindo Branch atual
- git checkout testing/routes

Nesta Branch quero commitar apenas este arquivo
- git add routes/web.php

Commit
- git commit -m "testando rota com middleware - hellouser"

Criando Branch no repositório remoto e enviando
- git push --set-upstream origin testing/routes

De volta ao GitHub, ao clicar no link "3 branches" a branch "testing/routes" deve aparecer na opção "Your branches", com o botão "New pull request".

Se aparecer esta frase:
- Able to merge. These branches can be automatically merged.

Siginifica que não há nenhum conflito.

Clicar no botão
- Create pull request

O GitHub tem algumas opções de configurar e definir regras, imagino que vc pode definir quem (outras pessoas) para fazer essa parte de analisar e gerenciar as "requisições de pull" e confirmar.

Clicar em "Merge pull request" para avançar, e pede mais uma vez para clicar em "Confirm merge" para finalizar.

De volta ao terminal, e voltando ao branch main
- git checkout main

Agora vou commitar denovo o README.md com esses passos:
- git add README.md
- git commit -m "passos criando mais uma branch sobre rotas"
- git push

Então, deu o erro abaixo ao executar "git push"
<pre>
 ! [rejected]        main -> main (fetch first)
error: failed to push some refs to 'github.com:cybervoigt/laravel-example-app-01.git'
hint: Updates were rejected because the remote contains work that you do
hint: not have locally. This is usually caused by another repository pushing
hint: to the same ref. You may want to first integrate the remote changes
hint: (e.g., 'git pull ...') before pushing again.
</pre>
Isso aconteceu porque o repositório remoto foi modificado, e preciso rodar um "git pull" para garantir que o repositório local esteja atualizado.

Primeiro:
- git reset (desfaz o git add, pois estou editando README.md)

Agora ao rodar este comando:
- git pull

Deu outro erro:
- fatal: Need to specify how to reconcile divergent branches.

Com umas dicas de como configurar isso no git.

Esse comando lista as configurações
- git config --list

Eu defini esta opção:
- git config pull.rebase false

E depois fiz o pull
- git pull

Abriu o editor nano pedindo pra escrever o motivo do merge, apenas pressionei CTRL+X pra sair.

O arquivo README.md não estava mais aparecendo como alterado no "git status", então rodei apenas "git push" e o arquivo foi enviado. Que confusão... 


# Criando Models de Atividades e Clientes

O que é uma Model ?
- https://laravel.com/docs/10.x/eloquent#introduction

Resumindo:
- uma Model é uma classe que representa uma tabela em um banco de dados.
- E cada objeto criado a partir dessa classe representa uma linha na respectiva tabela.
- É responsável pelo acesso e manipulação (CRUD) dos dados desta tabela.

O Laravel tem um módulo chamado Eloquent, um Object-Relational Mapper (ORM) que é responsável por fazer esta tarefa de Mapeamento Objeto-Relacional.

Esse foi o assunto do meu TCC (trabalho de conclusão de curso) em 2006: Aspectos de um framework para Mapeamento Objeto-Relacional.


Ideia inicial com apenas 2 tabelas:
- tabela de Ramos/Tipos de Atividades
- tabela de Clientes

Padrão a ser adotado:
- Nome das Models em inglês no singular: Activity e Customer.
- Nome das tabelas o Laravel vai definir automaticamente no plural: Activities e Customers.

Cada Cliente será associado a um Ramo de Atividade.

Exemplos (Seeds) de Ramos de Atividades:
- Construtora
- Revenda de Carros
- Supermercado
- Material de construção
- Material elétrico

## Criando Models

Rodar o comando "artisan" para criar a Model:
- ./vendor/bin/sail artisan make:model Activity -ms

Para ter mais informações, rodar comando com --help
- ./vendor/bin/sail artisan make:model --help

Junto com a criação do arquivo da classe Model:
- o parâmetro -m também cria o arquivo de Migration
- o parâmetro -s também cria o arquivo de Seeds

Resultado esperado:
- Model [app/Models/Activity.php] created successfully.  
- Migration [database/migrations/2023_12_09_221359_create_activities_table.php] created successfully.  
- Seeder [database/seeders/ActivitySeeder.php] created successfully.


## Migration

Sobre criação de tabelas com Migrations
- https://laravel.com/docs/10.x/migrations#tables

No arquivo "2023_12_09_221359_create_activities_table.php", a function "up" já contém 2 linhas:
- $table->id();
- $table->timestamps();

A primeira indica que a tabela terá uma coluna "id" que será a chave primária sequencial da tabela. E a segunda linha indica a criação automática de 2 campos tipo "timestamp" para guardar automaticamente a data e hora de criação (created_at) e edição (updated_at) do registro/linha/objeto.

Então, agora vou definir a estrutura da tabela adicionando estas linhas na function "up":
<pre>
$table->foreignId('user_id')->constrained();
$table->string('name', 100);
$table->string('description')->nullable();
$table->softDeletes();
</pre>

Sobre tipos de colunas:
- https://laravel.com/docs/10.x/migrations#available-column-types

Será criada uma coluna "user_id" tipo "chave estrangeira" que vai se relacionar com o usuário logado, da tabela "users".

Também serão criadas 2 colunas para guardar texto/string na tabela: name e description. Veja que eu defini o tamanho máximo de 100 caracteres para "name" e também defini que a coluna "description" pode ficar vazia, isto é, aceita NULL.

E a linha "softDeletes" será explicada mais abaixo, pois é um recurso que precisa ser definido na Model.

## Model

Nesta classe "Activity" será necessário criar a variável $fillable para informar os campos que normalmente a aplicação vai preencher:
<pre>
protected $fillable = [
    'user_id',
    'name',
    'description'
];
</pre>

### Definir o relacionamento entre uma Atividade e o usuário logado
- https://laravel.com/docs/10.x/eloquent-relationships#defining-relationships

Nesta mesma classe "Activity" vou incluir uma function para mapear o relacionamento entre a Atividade e o usuário que criou esta atividade:
<pre>
public function user()
{
    return $this->belongsTo(User::class);
}
</pre>

Já por outro lado, esta relação também pode ser implementada do ponto de vista do usuário, para indicar que ele "possui várias" Atividades.

Esta function "activities" pode ser criada na classe Model de usuários (app/Models/User.php) e retornará uma lista (Collection) das atividades relacionadas.
<pre>
public function activities()
{
    return $this->hasMany(Activity::class);
}
</pre>

### Soft Deleting
- https://laravel.com/docs/10.x/eloquent#soft-deleting

O Laravel fornece um recurso chamado "soft deleting" para quando não queremos excluir/deletar um registro da tabela, mas apenas desativar/inativar este registro/objeto. Semelhante ao campo "ativo"(S/N) que tenho feito em meus projetos, mas será criada uma coluna tipo "timestamp" para indicar a data e hora da "exclusão" do registro".

Para ativar este recurso na model de Atividades, é preciso adicionar a namespace "SoftDeletes" acima da classe Activity:
- use Illuminate\Database\Eloquent\SoftDeletes;

E dentro da classe Activity, basta adicionar "SoftDeletes" na linha "use":
- use HasFactory, SoftDeletes;

Dica: esta característica foi implementada no Laravel usando o recurso de "traits" do PHP:
- https://www.php.net/manual/pt_BR/language.oop5.traits.php

Esse recurso pode ser visto como uma forma de implementar "herança múltipla" de objetos.

## Seeder

Já no arquivo "ActivitySeeder.php" vamos programar a inserção de registros na tabela apenas com objetivo de testes e facilitar no processo de desenvolvimento.

Dentro da function "run" vai um bloco desse para cada linha que queremos inserir na tabela:
<pre>
DB::table('activities')->insert([
    'user_id' => 1,
    'name' => 'Construtora',
]);
</pre>

Repare que para aceitar o campo "user_id" igual a 1, deve ser criado o usuário (com id = 1) clicando no menu Register da tela inicial da aplicação, ou também pode ser criado um Seeder para a Model de Usuários.

Fonte:
- https://laravel.com/docs/10.x/seeding


### Criando um Seeder de usuários

Para não precisar incluir manualmente usuários, pelo menu Register, vou criar Seeder de 3 usuários fictícios com base neste exemplo
- https://laravel.com/docs/10.x/seeding#writing-seeders

Comando para criar um Seeder:
- ./vendor/bin/sail php artisan make:seeder UserSeeder

No arquivo UserSeeder.php, adicionar este bloco 3x na function run
<pre>
$name = Str::random(10);
DB::table('users')->insert([
    'name' => $name,
    'email' => $name.'@example.com',
    'password' => Hash::make('password'),
]);
</pre>


## Rodando Migration

O primeiro passo então é rodar a migration para criar a tabela no banco de dado:
- ./vendor/bin/sail php artisan migrate

Aparentemente deu certo, pois apareceu o nome do arquivo:
- 2023_12_10_221359_create_activities_table.php


Consultei no MySQL, e o comando "desc activities" retornou a estrutura da tabela:
<pre>
+-------------+-----------------+------+-----+---------+----------------+
| Field       | Type            | Null | Key | Default | Extra          |
+-------------+-----------------+------+-----+---------+----------------+
| id          | bigint unsigned | NO   | PRI | NULL    | auto_increment |
| user_id     | bigint unsigned | NO   | MUL | NULL    |                |
| name        | varchar(100)    | NO   |     | NULL    |                |
| description | varchar(255)    | YES  |     | NULL    |                |
| created_at  | timestamp       | YES  |     | NULL    |                |
| updated_at  | timestamp       | YES  |     | NULL    |                |
| deleted_at  | timestamp       | YES  |     | NULL    |                |
+-------------+-----------------+------+-----+---------+----------------+
7 rows in set (0.05 sec)
</pre>

## Rodando Seeder

E agora rodar o comando para executar o Seeder
- ./vendor/bin/sail php artisan db:seed

Acho que não deu certo, pois no resultado apareceu apenas
- Seeding database.

E não apareceu nome do arquivo "ActivitySeeder.php"

Acessei o MySQL e ao consultar a tabela com "select * from activities" retornou:
- Empty set (VAZIO, nenhum registro...)

Outra opção, agora passando o nome da class
- ./vendor/bin/sail php artisan db:seed --class=ActivitySeeder

Ainda não.

Uma dica que eu li na Internet seria verificar no arquivo
- DatabaseSeeder.php

E adicionar esta na linha na function "run":
<pre>
$this->call([
    UserSeeder::class,
    ActivitySeeder::class,
]);
</pre>

DONE!!!

<pre>
mysql> select * from activities;
+----+---------+------------------------+-------------+------------+------------+------------+
| id | user_id | name                   | description | created_at | updated_at | deleted_at |
+----+---------+------------------------+-------------+------------+------------+------------+
|  1 |       1 | Construtora            | NULL        | NULL       | NULL       | NULL       |
|  2 |       1 | Revenda de Carros      | NULL        | NULL       | NULL       | NULL       |
|  3 |       1 | Supermercado           | teste...    | NULL       | NULL       | NULL       |
|  4 |       1 | Material de constru��o | NULL        | NULL       | NULL       | NULL       |
|  5 |       1 | Material el�trico   | NULL        | NULL       | NULL       | NULL       |
+----+---------+------------------------+-------------+------------+------------+------------+
5 rows in set (0.00 sec)
</pre>

# Criando uma Rota para listar Atividades

Criando uma Rota para listar as Atividades do Usuário logado.

No arquivo web.php vamos adicionar uma nova rota, que vai acessar o usuário logado, acessar a function "activities" criada na Model do usuário, e chamar a function "all" do Laravel Eloquent, que retorna um array com a lista de itens encontrados.
<pre>
Route::get('/useractivities', function() {
    return auth()->user()->activities->all();
})->middleware(['auth', 'verified'])->name('useractivities');
</pre>

Ao rodar a aplicação e acessar esta rota:
- http://localhost/useractivities

O navegador deve mostrar todo o conteúdo da tabela em formato JSON:
<pre>
[{"id":1,"user_id":1,"name":"Construtora","description":null,"created_at":null,"updated_at":null,"deleted_at":null},{"id":2,"user_id":1,"name":"Revenda de Carros","description":null,"created_at":null,"updated_at":null,"deleted_at":null},{"id":3,"user_id":1,"name":"Supermercado","description":"teste...","created_at":null,"updated_at":null,"deleted_at":null},{"id":4,"user_id":1,"name":"Material de constru\u00e7\u00e3o","description":null,"created_at":null,"updated_at":null,"deleted_at":null},{"id":5,"user_id":1,"name":"Material de el\u00e9trico","description":null,"created_at":null,"updated_at":null,"deleted_at":null}]
</pre>


# Consultando e testando os dados

Para cosultar uma variável, o Laravel tem uma function chamada "dd" (Dump and Die), ela tem um comportamento semelhante a usar a combinação das functions "var_dump" e "die" nativas do PHP.

Fonte:
- https://laravel.com/docs/10.x/helpers#method-dd

Por exemplo, para visualizar mais detalhes sobre a lista de atividades, basta incluir esta linha dentro da rota "/useractivities":
- dd(auth()->user()->activities->all());


# Criando uma View com Blade

Criando uma view Blade para listar as Atividades do Usuário logado.

Fonte:
- https://laravel.com/docs/10.x/blade#introduction
- https://laravel.com/docs/10.x/frontend#introduction

Criei o arquivo "resources/views/myactivities.blade.php" como exemplo simples para listar os registros da tabela de atividades, relacionados ao usuário logado.

E na rota "/useractivities" ajustei o return para
- return View('myactivities');

Então, segundo uma dica que achei, NÃO é uma boa prática no Laravel fazer consultas ao banco de dados dentro das classes VIEW.

Isto é, na primeira versão do arquivo "myactivities.blade.php" foi usado esse trecho de código para buscar as atividades do usuário logado:
- auth()->user()->activities->all()


## Embutindo a view no template da aplicação

Para fins de estudos, a primeira versão do arquivo "myactivities.blade.php" foi criado contendo a estrutura completa de um arquivo HTML, deste a tag "DOCTYPE html" até o "/html", incluindo as outras tags "head" e "body".

Agora vou ajustar para que o conteúdo de "myactivities" seja embutido dentro do layout principal da aplicação, usando a tag "x-app-layout".

Analisando o arquivo "resouces/views/layouts/app.blade.php", vale destaque para 2 variáveis:
- $header
- $slot
("slot" que é usado para inserção de conteúdo dinâmico)




Próximo passo será criar uma classe CONTROLLER, e essa classe vai passar os dados necessários para a VIEW.


# Criando uma classe Controller

Fechando esse "triangulo amoroso" do MVC, agora vou criar o C de Controller.

Já criei o M de Model, que é a classe que abstrai o acesso e manipulação do banco de dados, implementado no Laravel com o "Eloquent ORM".

Já iniciei um exemplo da letra V de View, que é a parte visual da aplicação, a interface do suário, como o usuário vai ver e manipular os dados do sistema.

Uma classe Controller é responsável por receber, direcionar e responder as requisições recebidas no sistema, sejam requisições vindas do usuário ou de outra aplicação.

Vamos rodar o comando "artisan" para criar uma classe Controller para as Atividades:
- ./vendor/bin/sail php artisan make:controller ActivityController

Fonte:
- https://laravel.com/docs/10.x/controllers#introduction

Foi criado o seguinte arquivo:
- app/Http/Controllers/ActivityController.php

Vou criar uma função "index" e esta função vai retornar a View e passando a lista de Atividades:
<pre>
public function index()
{
    return View('myactivities', [
        'username' => auth()->user()->name,
        'activities' => auth()->user()->activities->all()
    ]);
}
</pre>

A "cereja do bolo" agora é ajustar a Rota "/useractivities" para que o processamento seja feito pelo Controller, e não mais seja diretamente retornada a View "myactivities".

No arquivo "routes/web.php" deve ser adicionada a classe:
- use App\Http\Controllers\ActivityController;

E a rota agora fica assim, apontando automaticamente para a function "index" da classe ActivityController:
<pre>
Route::get('/useractivities', [ActivityController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('useractivities');
</pre>

## Resource Controller

- https://laravel.com/docs/10.x/controllers#resource-controllers

Ao rodar o comando "artisan make:controller" o parâmetro --resource pode ser adicionado para criar automaticamente métodos padrões (geralmente usados para implementar CRUD: index, create, store, show, edit, update e destroy) na classe Controller.

E para criar uma Rota (no web.php) que vai ler automaticamente estes métodos do controller, deve ser usada a opção "resource":
- Route::resource('activity', ActivityController::class);

Para listar as rotas disponíveis na aplicação, relacionadas a palavra "activity", basta rodar este comando
- ./vendor/bin/sail php artisan route:list --path=activity

Fonte:
- https://laravel.com/docs/10.x/routing#the-route-list

Para desativar alguma dessas Rotas, basta usar a function "except" ou "only".

Por exemplo, usando "except" para desativar a rota "delete" para o método "destroy":
<pre>
Route::resource('activity', ActivityController::class)
    ->except('destroy')
    ->middleware(['auth', 'verified']);
</pre>

Outro exemplo, se dentro do método "show" do Controller, adicionar esta linha:
- return $id

Para apenas retornar o parâmetro $id recebido, ao abrir este caminho na aplicação
- http://localhost/activity/1234

Será exibido apenas o número 1234 no navegador.


## Fazendo "Model binding"
- https://laravel.com/docs/10.x/routing#route-model-binding

Outra situação de exemplo, digamos que o usuário queira que a rota seja escrita em português, ao inves do padrão em inglês do Laravel.

A Rota pode ser escrita em Português
<pre>
Route::resource('atividades', ActivityController::class)
    ->except('destroy')
    ->middleware(['auth', 'verified']);
</pre>

Consultando novamente as rotas:
- ./vendor/bin/sail php artisan route:list --path=atividades

Vou pegar o exemplo do método "show" novamente:
<pre>
GET|HEAD        atividades/{atividade} .............................. atividades.show › ActivityController@show
</pre>

Veja que o nome do parâmetro {atividade} agora está em portugues, e precisa ser redefinido para o mesmo nome da classe Model.
<pre>
Route::resource('atividade', ActivityController::class)
    ->parameters([
        'atividade'=>'activity'
    ])
    ...
</pre>

Sensacional... Ao abrir este caminho:
- http://localhost/atividade/1

Os dados do objeto/linha da tabela é retornada em JSON:
<pre>
{"id":1,"user_id":1,"name":"Construtora","description":null,"created_at":null,"updated_at":null,"deleted_at":null}
</pre>

Pergunta: onde seria o ponto ideal agora pra validar se o objeto encontrado, está relacionado ou pertence ao usuário logado?
- Imagino que seja dentro do Controller.
- Essa regra pode ser feita com "Query Scope", ver mais abaixo como criar...

Por enquanto vou deixar esse IF dentro do método "show" do Controller:
<pre>
if(auth()->user()->id == $activity->user_id)
{
    return $activity;
}
</pre>

Depois que eu criei uma "Query Scope" para a model de Atividades, não precisa mais ser feito o if acima testando se a atividade está relacionada ao usuário.

Ao tentar acessar o id de uma atividade relacionada a outro usuário o Laravel já retorna "404 | Not found"
- http://localhost/atividade/10



### Situação 1

Eu adicionei mais usuários de teste, e no arquivo ActivitySeeder.php eu inseri mais linhas relacionadas a estes outros usuários.

Ao tentar passar um ID de um registro relacionado a outro usuário, está ficando uma tela em branco, por exemplo:
- http://localhost/atividade/9


### Situação 2

Outra situação, é ao tentar passar um ID inexistente, por exemplo:
- http://localhost/atividade/999

Depois de criada a "Query Scope" ambas as situações acima estão retornando a mensagem padrão do Laravel "404 | Not found"


## Definindo Middleware em uma classe Controller

Também é possível definir um Middleware dentro do construtor de um Controller
<pre>
public function __construct()
{
    $this->middleware(...)
}
</pre>

- https://laravel.com/docs/10.x/controllers#controller-middleware


# Requisções HTTP
- https://laravel.com/docs/10.x/requests#introduction

No caso da necessidade de serem passados mais parâmetros na URL da aplicação, por exemplo na roda "/useractivities":
- http://localhost/useractivities/?filterName=helloword

Precisamos de um parâmetro Request no Controller para ler o parâmetro "filterName" da requisição:
<pre>
public function index(Request $request)
{
    $params = $request->all();
    return View('myactivities', [
        'username' => auth()->user()->name,
        'activities' => auth()->user()->activities->all(),
        'filterName' => isset($params['filterName']) ? $params['filterName'] : '',
    ]);
}
</pre>

# Usando o programa Insomnia

O programa Insomnia é semelhante ao programa Postman, e serve para testar requisições HTTP.
- https://insomnia.rest/download

Por exemplo, enquanto eu ainda não fiz um Form na aplicação Laravel para gravar um novo registro na tabela, quero testar a rota abaixo que vai receber o POST e criar o objeto/linha na tabela: 
<pre>
POST            atividade ........................... atividade.store › ActivityController@store
</pre>

Pelo que entendi, por padrão o Laravel retornaria o erro "419 | PAGE EXPIRED".

Então tive de adicionar "withoutMiddleware" na rota "Route::resource('atividade',":
<pre>
->withoutMiddleware([
    TrustProxies::class,
    VerifyCsrfToken::class
])
</pre>

Para conseguir enviar um POST e inserir um novo registro na tabela, usando o programa Insomnia.


# Usando Collections (ao inves de Arrays)

- https://laravel.com/docs/10.x/collections#introduction

Ao rodar esta linha de código no Controller (no array de parametros passados para a View):
- 'activities' => auth()->user()->activities->all(),

A function "all" é um método do objeto Collection (retornado pela function "activities"), e que retorna um Array.

Por exemplo, se for necessário passar para a View mais um parâmetro com a quantidade de itens da lista, ao invés de retornar um Array e usar a function "count" do PHP:
- 'count' => count(auth()->user()->activities->all()),

É possível chamar a function "count" do próprio Collection:
- 'count' => auth()->user()->activities->count(),


# Fazendo consultas na tabela de Atividades

Usando a function index do ActivityController como exemplo, outra forma de buscar os registros da tabela de Atividades (activities) é usando o facade DB:
- https://laravel.com/docs/10.x/database#running-queries

Assim retorna um Array com todas as linhas:
- $activities = DB::select('select * from activities');

Assim retorna um Collection com todas as linhas:
- $activities = DB::table('activities')->get();

E agora retorna um Collection com as atividades do usuário logado e onde o nome contém $filterName:
<pre>
$activities = DB::table('activities')
    ->where('user_id', auth()->user()->id)
    ->where('name', 'like', '%' . $filterName . '%')
    ->get();
</pre>

Por exemplo, ao executar esta Rota/URL:
- http://localhost/useractivities/?filterName=constr

Devem ser listados estes registros na tela, para o usuário logado ID=1:
- Construtora
- Material de construção


# Validando dados de uma Requisição

- https://laravel.com/docs/10.x/validation#introduction
- https://laravel.com/docs/10.x/validation#quick-writing-the-validation-logic

Vou escrever sobre isso mais tarde... fiz uns testes verificando a variável $filterName, com "max:20"



# Criando um formulário com Blade

Criei o arquivo "activity.blade.php" baseado no exemplo do Módulo "Especialista Laravel".
- https://laravel.com/docs/10.x/blade#forms




# Métodos "create" e "store" do Controller

O método "create" é responsável por trazer o Formulário para o usuário:
<pre>
public function create()
{
    return View('activity');
}
</pre>

Enquanto que o método "store" será responsável por receber os dados vindos do Formulário e gravar o objeto/linha no banco de dados.
<pre>
public function store(ActivityRequest $request)
{
    $requestData = $request->all();
    $requestData['user_id'] = auth()->user()->id;
    return Activity::create($requestData);
}
</pre>

# Criando um FormRequest

Para validar os dados recebidos em uma requisição, vinda de um formulário, criamos um "form request".
- https://laravel.com/docs/10.x/validation#form-request-validation

Comando Artisan para criar o "form request" com nome ActivityRequest:
- ./vendor/bin/sail php artisan make:request ActivityRequest

Arquivo criado:
- app/Http/Requests/ActivityRequest.php

Nesta classe, temos que definir as regras desejadas no método "rules".

Por exemplo, vou aplicar uma regra para definir que o campo "name" é de preenchimento obrigatório:
<pre>
public function rules(): array
{
    return [
        'name' => 'required'
    ];
}
</pre>

Também mudei o return da function authorize() de false pra true.

Agora sim, eu consegui chamar o form:
- http://localhost/atividade/create

E ao clicar no botão CADASTRAR, é feita a validação de que "name" precisa ser preenchido.

Ao digitar algum valor e tentar novamente, o registro foi gravado com suceso e seus dados retornados para o navegador pelo método "store".



# Criando uma Policy.

- https://laravel.com/docs/10.x/authorization#creating-policies

Policies são classes responsáveis por organizar a lógica de autorização de acessos a uma classe Model.

Comando para criar:
- ./vendor/bin/sail artisan make:policy ActivityPolicy

Implementar os métodos que realização a devida validação.

Neste caso, quero testar se o usuário logado por editar ou excluir uma Atividade.

<pre>
public function update(User $user, Activity $activity): bool
{
    return $user->id === $activity->user_id;
}
public function delete(User $user, Activity $activity): bool
{
    return $user->id === $activity->user_id;
}
</pre>

Registrar a Policy na classe AuthServiceProvider, adicionando na propriedade $policies:
<pre>
protected $policies = [
        Activity::class => ActivityPolicy::class,
    ];
</pre>


# Criando uma Query Scope.

- https://laravel.com/docs/10.x/eloquent#query-scopes

Outra forma de criar restrições e controlar a autorização de acesso aos registros/objetos de uma classe Model, é por meio de Query Scopes.

Comando para criar:
- ./vendor/bin/sail artisan make:scope ActivityScope

Na classe ActivityScope, na function apply, esta linha vai criar o filtro:
<pre>
$builder->where('user_id', '=', auth()->user()->id)
</pre>

Para ativar/registrar a Query Scope, agora precisamos incluir a function booted na classe Model "Activity":
<pre>
protected static function booted(): void
{
    static::addGlobalScope(new ActivityScope);
}
</pre>

<hr>
to be continued...
