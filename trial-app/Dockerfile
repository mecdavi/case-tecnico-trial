FROM node:25-bullseye

# Evita prompts interativos
#ENV DEBIAN_FRONTEND=noninteractive

# Instalar dependências do sistema (sem pacotes obsoletos)
RUN set -eux; \
    apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y \
        wget \
        build-essential \
        libssl-dev \
        zlib1g-dev \
        libncurses5-dev \
        libncursesw5-dev \
        libreadline-dev \
        libsqlite3-dev \
        libgdbm-dev \
        libdb-dev \              
        libbz2-dev \
        libexpat1-dev \
        liblzma-dev \
        tk-dev \
        curl \
        libffi-dev \
        make \
        gcc \
        libxml2-dev \
        libxmlsec1-dev \
        libcurl4-openssl-dev \
        && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar ferramentas globais
RUN apt-get update && apt-get install -y git
RUN npm install -g typescript eslint @quasar/cli

# Definir diretório de trabalho
WORKDIR /app/trial-app

# Copiar apenas arquivos de dependências (melhora cache)
COPY package.json ./


# Instalar dependências
#RUN yarn install --frozen-lockfile

# Copiar o restante do código
COPY . .

WORKDIR /app/trial-app
RUN npm install

# Expor porta do Quasar
EXPOSE 9000

# Comando padrão
CMD ["quasar", "dev"]
#CMD ["/bin/bash"]
#CMD ["tail", "-f", "/dev/null"]


