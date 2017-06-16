#!/bin/sh

REPO=$1
IS_BARE=$2

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
  git init $REPO
else
  git init --bare $REPO
fi

echo "Repo $REPO Created"
exit
