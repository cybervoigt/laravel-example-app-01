<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Estudando Laravel

Aqui vão os passos que segui para criar um projeto Laravel para estudos, usando 2 computadores (1 Ubuntu e outro Windows com WSL2):

- Instalando Docker engine.
- Criando um projeto Laravel com Docker.
- Criando chave SSH para autenticação no GitHub.
- Criando este repositório aqui no GitHub e salvando o projeto.
- Baixando o projeto (clone) em outro computador.
- Executando o projeto em outro computador.
- .
- .
- .
- .

Objetivo Principal:
- criar pelo menos um CRUD!

Objetivos secundários:
- Dominar Laravel
- Praticar Git e GitHub
- Conhecer mais sobre Docker
- (se possível ainda, criar testes unitários: PHPUnit ou Pest)
- (se possível ainda, fazer o deploy em um serviço de cloud)


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

Fonte:

- https://laravel.com/docs/10.x/installation#sail-on-linux

Rodei este comando

- curl -s https://laravel.build/laravel-example-app-01 | bash

Na primeira tentativa deu erro "Docker is not running", pois não tinha executado os 2 comandos citados após instalação.

Resultado esperado:

- Thank you! We hope you build something incredible.

Rodando a Aplicação com o comando sail up (parametro -d serve para não bloquear o terminal)

- ./vendor/bin/sail up -d

Abrir a aplicação no navegador com http://localhost/ 

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


# Criando este repositório aqui no GitHub e salvando o projeto.

Acessar o GitHub, aba Repositories, botão New;

Informei o mesmo nome "laravel-example-app-01" da pasta

Após criar o repositório, clicar no botão SSH na caixa Quick setup:

seguir as dicas de comandos listados abaixo:
…or create a new repository on the command line</br>
echo "# laravel-example-app-01" >> README.md</br>
  git init</br>
  git add README.md</br>
  git commit -m "first commit"</br>
  git branch -M main</br>
  git remote add origin git@github.com:cybervoigt/laravel-example-app-01.git</br>
  git push -u origin main</br>

Entrar na pasta do projeto
- cd ~/laravel-example-app-01/

Comando para iniciar o repositorio local
- git init

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

Gerar a chave SSH para ter acesso ao repositorio

Comando para baixar o repositório
- git clone git@github.com:cybervoigt/laravel-example-app-01.git

É possível clonar um repositório público sem SSH, mas entendi que precisa de chaves SSH para trabalhar com repositórios privados.

Se for necessário zerar tudo no computador local e começar denovo, este é comando para excluir a pasta do projeto:
- rm -rf laravel-example-app-01/
- Lembrar de commitar este arquivo README.md antes de excluir a pasta!

# Executando o projeto em outro computador.

A pasta "vendor" é onde o composer guarda as dependências, isto é, pacotes e bibliotecas de terceiros que o projeto precisa para ser executado.

Ela não precisa ser enviada ao GitHub, por isso ela já se encontra na lista do arquivo .gitignore.

Será necessário instalar PHP+Composer, para criar a pasta vendo com as dependencias, incluindo o "sail".

## Opção 1 - executando composer com Docker

Ou não, depois descobri que é possível rodar o composer usando Docker.
- criei o arquivo "script_docker_run" baseado na aula do Beer and code

Código do arquivo "script_docker_run":
<pre>
#!/usr/bin/env bash
docker run --rm -i \
 -v $PWD:/app \
 -u $(id -u):$(id -g) \
 composer:2.4.2 "$@"
 </pre>

Permissão de executar o arquivo "script_docker_run"
- chmod +x script_docker_run

Executando:
- ./script_docker_run composer install


## Opção 2 - executando composer diretamente no Linux

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
- git checkout feature/breeze

Definindo a Branch que vou trabalhar agora
- git checkout feature/breeze

Ao listar novamente com o comando "git branch" devem aparecer 2 itens:
- feature/breeze
- main

# Instalando Laravel/Breeze para autenticação

Então, Breeze é um módulo/pacote pronto para autenticação de usuários em uma aplicação Laravel.

Fonte:
- https://laravel.com/docs/10.x/starter-kits#laravel-breeze


Rodar este comando para adicionar a dependência:
- ./vendor/bin/sail composer require laravel/breeze --dev

Depois rodar este comando para instalar o Breeze:
- ./vendor/bin/sail artisan breeze:install

Para esta instalação serão feitas algumas perguntas.
- faltou listar aqui... selecionei Blade.

Serão criados e alterados alguns arquivos que podem ser listados rodando "git status".

Na tela inicial da aplicação também devem aparecer 2 novos links:
- Log in (acessar o sistema)
- Register (criar um novo usuário)


## Percauços e tropeços com banco de dados MySQL e Docker

Ao rodar a aplicação e tentar incluir um usuário clicando no menu Register, deu erro de:
- SQLSTATE[HY000] [2002] Connection refused

Verifiquei que o container do MYSQL não está em execução. Se tiver instalado, também pode ser verificado no Docker Desktop.
- docker ps

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

Denovo, após rodar denovo a aplicação, ao clicar no menu Register e tentar criar um usuário, erro continua:
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

## Solução
Então, neste exato momento eu não tenho acesso ao primeiro computador onde criei o projeto Laravel, pra ver as configurações no arquivo .env original.

Mas lembrei de ter visto em alguma video aula do "Beer and code" sobre configurar o DB_HOST com "mysql" ao inves de "localhost" ou "127.0.0.1", pelo menos em ambiente de desenvolvimento.
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

Imagino que o Blade (templating engine) use algumas biliotecas JavaScript para fazer a parte visual das aplicações (view).

Rodei os outros comandos usando o sail/docker:
- ./vendor/bin/sail npm install
- ./vendor/bin/sail npm run dev

Ao rodar o "npm run dev", foram atualizadas as dependências de bibliotecas de terceiros, no arquivo "package.json", mais ou menos como é feito com o arquivo "composer.json".

No arquivo package.json foram incluídos itens como:
- tailwindcss
- alpinejs

Agora sim, um novo usuário pode ser incluído usando o menu Register.









