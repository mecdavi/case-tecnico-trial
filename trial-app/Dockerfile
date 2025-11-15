FROM node:25-bullseye

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

RUN apt-get update && apt-get install -y git
RUN npm install -g typescript eslint @quasar/cli

WORKDIR /app/trial-app

COPY package.json ./

COPY . .

WORKDIR /app/trial-app
RUN npm install

EXPOSE 9000

CMD ["quasar", "dev"]
#CMD ["tail", "-f", "/dev/null"]


