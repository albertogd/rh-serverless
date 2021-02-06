#!/bin/bash

NC='\033[0m'
RED='\033[0;31m'
GREEN='\033[0;32m'
URL=$(oc get ksvc nodejs-app -o json | jq -r '.status.url')
TOTAL_REQ=20

while true; do
  for i in $(seq 1 $TOTAL_REQ); do
    printf "Request #$i: "
    count=$(curl -s $URL | grep -ic version)
    if [ "$count" -eq "1" ]; then
      printf "${GREEN}OK${NC}\n"
    else
      printf "${RED}KO${NC}\n"
    fi
  done

  sleep 1s
done
