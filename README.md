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

Resultado: será criada uma pasta .ssh contendo 2 arquivos dentro

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

Acessar o GitHub, aba Repositories, botão New

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

Testar status do repositório. Os arquivos na cor vermelha não estão sendo monitorados pelo git.
- git status

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

É possível clonar um repositório público sem SSH, mas assim é como se faz com repositórios privados.


# Executando o projeto em outro computador.

A pasta vendor é onde o composer guarda as dependências, isto é, pacotes e bibliotecas de terceiros que o projeto precisa para executar.

Será necessário instalar PHP+Composer

Atualizando repositórios de pacotes do Linux
- sudo apt-get update

Instalando PHP
- sudo apt install php8.1-cli

Instalar o composer:
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

Depois de rodar, fiquei na dúvida se o certo era "composer update" ou "composer install"
 - composer update

A pasta "vendor" é criada e gerenciada pelo "composer", e ela não precisa ser enviada ao GitHub, por isso ela já se encontra na lista do arquivo .gitignore.

O arquivo "composer.lock" também foi criado, e nele é gravada a versão instalada de cada pacote ou biblioteca de terceiro.


Criando/copiando arquivo .env a partir do .env.example
- cp .env.example .env

Veja que o campo APP_KEY está vazio dentro do arquivo .env

Comando para criar uma chave para a aplicação
- php artisan key:generate


Rodar a aplicação
- ./vendor/bin/sail up -d

