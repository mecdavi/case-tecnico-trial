# case-tecnico-trial

sistema de gerenciamento de usuario:
- Crud de usuário com atribuição de permissão;
- Usado RBAC (Controle de Acesso Baseado em Funções);

## Comandos para rodar o projeto:

### Docker:
  - Necessário ter o docker-compose ja instalado e configurado.
  - clone o projeto para sua máquina
  ```bash
    git clone https://github.com/mecdavi/case-tecnico-trial.git
  ```
  - na pasta do projeto rode o comando para criação dos containers:
  ```bash
    docker-compose up
  ```
  Quando terminar a criação dos containers, acesse a rota http://localhost:9000/#/login no seu navegador.

### Local:
  - clone o projeto para sua máquina
  ```bash
    git clone https://github.com/mecdavi/case-tecnico-trial.git
  ```
  #### Stack:
  necessária para rodar
    - php 8.4
    - node 25
  

  




