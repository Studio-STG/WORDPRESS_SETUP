#!/bin/bash

# Load environment variables from the .env file in the project root
set -o allexport
source "$(dirname "$0")/../.env"
set +o allexport

# Check if the MySQL container is running
if [ "$(docker ps -q -f name=stg_mysql_container)" ]; then
  # Generate a database dump with the --no-tablespaces option
  docker exec stg_mysql_container /usr/bin/mysqldump --no-tablespaces -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" > dump.sql
  if [ $? -eq 0 ]; then
    echo "Database dump created successfully: dump.sql"
  else
    echo "Failed to create database dump. Please check your MySQL credentials and database name."
  fi
else
  echo "The MySQL container is not running."
fi
