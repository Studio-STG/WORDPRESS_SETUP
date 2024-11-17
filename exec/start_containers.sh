#!/bin/bash

# Starting the containers in the background
docker-compose up -d

# Displaying access URLs
echo -e "\nAccess URLs:"
echo "- WordPress: http://localhost:8000"
echo "- phpMyAdmin: http://localhost:8080"
