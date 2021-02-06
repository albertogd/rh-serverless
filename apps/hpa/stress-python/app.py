#!/usr/bin/python
from flask import Flask, request, jsonify, make_response
import requests
import time
from multiprocessing import Pool
from multiprocessing import cpu_count


application = Flask(__name__)

@application.route('/healthz')
def healthz():
    return make_response(jsonify({"health": "ok"}), 200)

@application.route('/memory/<int:size>/<int:minutes>')
def memory(size, minutes):
    seconds = minutes*60

    try:
      dummy = ' ' * 1024 * 1024 * size
    except MemoryError:
      return make_response("Ran out of memory", 400)
    time.sleep(seconds)
    dummy = ''

    return make_response("", 200)

def f(x):
    timeout = time.time() + 60*float(cpu_minutes)  # X minutes from now
    while True:
        if time.time() > timeout:
            break
        x*x

@application.route('/cpu/<int:minutes>')
def cpu(minutes):

    global cpu_minutes
    cpu_minutes = minutes
    processes = cpu_count()
    pool = Pool(processes)
    pool.map(f, range(processes))
    pool.close()
    return make_response(jsonify({"CPU Lod Finished": "ok"}), 200)

if __name__ == '__main__':
     application.run(host='0.0.0.0',port=8080)
