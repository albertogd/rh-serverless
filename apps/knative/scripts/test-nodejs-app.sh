#!/bin/bash

NC='\033[0m'
RED='\033[0;31m'
GREEN='\033[0;32m'
URL=$(oc get ksvc nodejs-app -o json | jq -r '.status.url')
TOTAL_REQ=20

while true; do
  for i in $(seq 1 $TOTAL_REQ); do
    tstart=$(date +%s.%N)
    content=$(curl -s $URL)
    tend=$(date +%s.%N)
    tconsumed=$(echo "scale=2; ($tend-$tstart)/1" |bc -l)
    count=$(echo $content | grep -ic version)
    version=$(echo $content | egrep -o "Version.*?0")

    printf "Request #$i: "
    if [ "$count" -eq "1" ]; then
      printf "${GREEN}OK${NC} | ${version} | Time: ${tconsumed}s\n"
    else
      printf "${RED}KO${NC}\n"
    fi
  done

  sleep 1s
done
