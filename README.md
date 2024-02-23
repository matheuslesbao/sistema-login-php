### Pré-requisitos

* Docker
* Docker compose

### Instalação

Passo a passo para você rodar este projeto localmente:

* crie um fork e clone na sua máquina
* siga os comandos a baixo para subir a aplicação
```
$ docker compose up -d or docker-compose up
$ docker exec app composer install

```
Acesso ao mysql
```
docker-compose exec mysql mysql -u user -p
```
aplicação está disponível em [http://localhost:8000](http://localhost:8000)

## Tecnologias utilizadas

* Docker | Docker Compose
* PHP 8.2
* Nginx
* Mysql
## Modelagem de dados

```markdown
# Tabela: users

| Coluna      | Tipo          | Constraint
|-------------|---------------|-------------
| id          | INT (NOT NULL)| PK
| name        | VARCHAR (255) |
| username    | VARCHAR       | UK
| email       | VARCHAR (255) | UK
| password    | VARCHAR (255) |
| date        | VARCHAR (255) | NOT DEFAULT

```
