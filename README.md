# Code Test

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Load docker images from archive **OR** build from Dockerfile
    1. Run `docker load -i codetest-caddy.tar; docker load -i codetest-php.tar` to load docker images from archive
    2. Run `make build` to build fresh images from Dockerfile
3. Run `make up` to start the docker containers in detached mode (no logs)
4. Run `make sf c='doctrine:fixtures:load --no-interaction'` to generate fixtures (sample data)
5. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
6. Run `make down` to stop the Docker containers.
