#!/bin/bash

REPO=$1
LOCAL_CLONE=$2
REPO_NAME=$3

if [ -z $REPO ]; then
  echo "Repo Name not set"
  exit
fi

if [ -z $LOCAL_CLONE ]; then
  echo "Local Clone Repo not set"
  exit
fi

if [ -z $REPO_NAME ]; then
  echo "Clone Repo Name not set"
  exit
fi

echo "Clone new Git Repo $REPO to $LOCAL_CLONE"

if [ ! -d "$LOCAL_CLONE" ]; then
  echo "Creating Clone folder: $LOCAL_CLONE"
  mkdir $LOCAL_CLONE
fi

cd $LOCAL_CLONE
git clone $REPO

cd $REPO
cat << 'FOE' > hooks/post-receive
#!/bin/bash

unset $(git rev-parse --local-env-vars)
FOE

cat << EOF2 >> hooks/post-receive
cd ${LOCAL_CLONE}/${REPO_NAME}
git pull
EOF2
chmod +x hooks/post-receive

echo "Repo $REPO Cloned to $LOCAL_CLONE"
exit
