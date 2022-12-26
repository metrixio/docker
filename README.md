# Docker metrics collector

![docker](https://user-images.githubusercontent.com/773481/209433247-decbb4f6-e722-4862-8063-d4e4f0bf3c29.png)


This tool lets you easily gather data about downloads, stars, and followers from Docker Hub. 

It works with Prometheus and Grafana to collect data from Docker, store it in Prometheus, and create visualizations with Grafana. You can use Grafana to customize the data you collect and create dashboards that fit your needs.

We hope you find it helpful!

## Dashboard

![image](https://user-images.githubusercontent.com/773481/209438291-a887500d-7425-4f95-88db-f05261d728e6.png)

## Usage

Check out the documentation in the [dashboard](https://github.com/metrixio/dashboard) repository. That should give you all the details you need to get going.

```dotenv
# Docker repository names to follow (comma separated)
DOCKER_REPOSITORIES= ...
```

### Docker

```yaml
version: "3.7"

services:
  docker-metrics:
    image: ghcr.io/metrixio/docker:latest
    environment:
        DOCKER_REPOSITORIES: ...
    restart: on-failure

  prometheus:
    image: prom/prometheus
    volumes:
      - ./runtime/prometheus:/prometheus
    restart: always

  grafana:
    image: grafana/grafana
    depends_on:
      - prometheus
    ports:
      - 3000:3000
    volumes:
      - ./runtime/grafana:/var/lib/grafana
    restart: always
```

### Local server

```bash
composer create-project metrixio/docker
```

Define the repositories you want to track in `.env` file

```dotenv
DOCKER_REPOSITORIES=spiral/roadrunner,...
```

Once the project is installed and configured you can start application server:

```bash
./rr serve
```

-----

The package is built with some of the best tools out there for PHP. It's powered by [Spiral Framework](https://github.com/spiral/framework/), which makes it super fast and efficient, and it uses [RoadRunner](https://github.com/roadrunner-server/roadrunner) as the server, which is a really great tool for collecting metrics data for Prometheus.
