# Docker metrics collector

Welcome to the Docker metrics collector!

This package allows you to easily collect various metrics from Docker, such as downloads, stars and followers.
With this tool, you can track the performance of your own Docker account, or gather data for research or
analysis purposes.

It is designed to work seamlessly with Prometheus and Grafana. It will collect data from Docker and send it to
Prometheus for storage, and then use Grafana to visualize the data in beautiful and informative dashboards. Grafana
offers a variety of options for filtering and specifying the data you want to collect, so you can customize your metrics
collection to fit your needs.

It uses GRPC service to manage Docker accounts. GRPC is a high-performance.

We hope you find this package useful!

## Usage

```dotenv
# Docker repository names to follow (comma separated)
DOCKER_REPOSITORIES=
```

### Docker

```yaml
version: "3.7"

services:
  docker-metrics:
    image: ghcr.io/metrixio/docker:latest
    environment:
        DOCKER_REPOSITORIES:...
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
