#!/bin/bash

# Load environment variables from the .env file in the project root
set -o allexport
source "$(dirname "$0")/../.env"
set +o allexport

# Check if the dump file exists
if [ -f dump.sql ]; then
  # Check if the MySQL container is running
  if [ "$(docker ps -q -f name=stg_mysql_container)" ]; then
    # Restore the database from the dump
    docker exec -i stg_mysql_container /usr/bin/mysql -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" < dump.sql
    if [ $? -eq 0 ]; then
      echo "Database restored from dump.sql"
    else
      echo "Failed to restore the database. Please check your MySQL credentials and database name."
    fi
  else
    echo "The MySQL container is not running."
  fi
else
  echo "The dump.sql file was not found."
fi
