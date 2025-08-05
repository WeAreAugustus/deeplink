#!/bin/bash

# Stop and remove old container if exists
echo "Stopping and removing existing container (if any)..."
docker rm -f deeplink 2>/dev/null

# Build image
echo "Building Docker image..."
docker build -t deeplink .

# Run container on port 5048
echo "Running container on port 5048..."
docker run -d -p 5048:80 --name deeplink \
  -v /home/ubuntu/.well-known:/var/www/html/public/.well-known:ro \
  deeplink
