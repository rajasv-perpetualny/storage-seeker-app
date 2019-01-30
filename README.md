# Storageseeker

The Storageseeker site and server project.


This currently builds a basic Apache 2 and PHP 7 base image with an apache virtual host pointing at /service/web as the root directory in the docker instance.

The dev, stage and production port that has been assigned to storageseeker is 9107.

# Development

## Environment dependencies

To start up the project for development, you will require a few dependencies installed on the host machine, these dependencies are as follows.

[Docker and docker-compose](https://www.docker.com/community-edition) (same install for both) 


## Quick start

This project uses docker and docker-compose, both installed as part of docker, to handle environment configuration such as additional architecture dependencies, networking and environment variable setup. So, to set up your project for development run the following provided script:

> sh start.sh 

This will handle dependencies for you and start up the [development server](http://localhost:9107) at port **9107**.


**Note**: the first time you run `docker-compose up`, it will build the docker container from scratch, which might take a few minutes. This operation only needs to happen once. 

In case you need to change Docker specific settings, you would need to re build the container by running `docker-compose build` and re-starting the docker container by `running docker-compose up` again



