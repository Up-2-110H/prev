#!/usr/bin/env bash

./docker-exec framework/yii migrate/up-all
./docker-exec framework/yii access/install
./docker-exec framework/yii cache/flush-all
