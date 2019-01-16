# Camagru

![https://img.shields.io/badge/Grade-115%2F100-green.svg](https://img.shields.io/badge/Grade-115%2F100-green.svg)

## Installation 

This installation process is for macOS X

1. Install and update [HomeBrew](https://brew.sh/)
    
    ```bash
    /usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)" && brew update
    ```

2. Install [docker](https://www.docker.com/) and [docker-machine](https://docs.docker.com/machine/) via HomeBrew
    
    ```bash
    brew install docker docker-machine
    ```

3. Clone or download/extract the project repository
    
    ```bash
    git clone https://github.com/gde-pass/camagru.git && cd camagru
    ```

4. Create and start a docker-machine
    
    ```bash
    docker-machine create Camagru && docker-machine start Camagru
    ```

5. Link your environment 

    ```bash
    eval $(docker-machine env Camagru)   
    ```

6. Execute the [docker-compose](https://docs.docker.com/compose/) file in the docker-lamp folder
    
    ```bash
    docker-compose up 
    ```
