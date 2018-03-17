#!/bin/bash

REPO=$1
IS_BARE=$2
HTTP_CLONE=$3

if [ -z $REPO ]; then
  echo "Repo Name not set"
  exit
fi

echo "Create new Git Repo $1"

if [ -d "$REPO" ]; then
  echo "Repo $REPO already exists!"
  exit
fi

if [ -z $IS_BARE ]; then
  echo 'Error IS_BARE not set'
  exit
fi

if [ "$IS_BARE" == "N" ]
then
  git init $REPO
else
  echo 'Base repo selected'
  git init --bare $REPO
fi

if [ -z $HTTP_CLONE ]; then
  echo 'Error HTTP_CLONE not set'
  exit
fi

if [ "$HTTP_CLONE" == "Y" ]
then
  echo 'HTTP Clone Enabled'
  mv $REPO/hooks/post-update.sample $REPO/hooks/post-update
else
  echo 'Http Clone Disabled'
fi

echo "Repo $REPO Created"
exit
