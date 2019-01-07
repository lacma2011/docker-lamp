#!/bin/bash
# example to login to running workspace. Be sure to replace container ID with actual workspace ID
docker exec -it -u $(id -u):$(id -g) bac6bfbdebfe /bin/bash

