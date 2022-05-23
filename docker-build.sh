#!/usr/bin/env bash
 docker-compose up  --build
# docker run –rm -p 8080:80 app-weather
# docker-compose exec app-weather /bin/bash

# deploy on docker
# docker tag app-weather:latest coundia/app-weather:latest
# docker push coundia/app-weather:latest

