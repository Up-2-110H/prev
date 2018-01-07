#!/usr/bin/env sh

./docker.sh exec framework/yii migrate/up-all
./docker.sh exec framework/yii access/install
./docker.sh exec framework/yii cache/flush-all
