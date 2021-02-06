#!/bin/bash

if [ "$#" -ne 1 ]; then
    echo "Need the number of PODs to create"
    exit 1
else
    REQS=$1
fi

URL=$(oc get ksvc quarkus-app -o json | jq -r '.status.url')
REQ_PER_POD=5
TOTAL_REQ=$((REQ_PER_POD*REQS))

while true; do
  for i in $(seq 1 $TOTAL_REQ); do
    #echo "Request #$i:"
    curl $URL > /dev/null 2>&1 &
  done

  echo "Current pod nº: $(oc get pods -o name --field-selector status.phase=Running -l app=quarkus-app | wc -l)" 
  sleep 1s
done
