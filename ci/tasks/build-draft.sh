#!/bin/sh


echo "Creating build-project directory"
mkdir build-project

echo "Coping vendor from php"
cp -r built-project-php/vendor build-project/vendor

set +e
cd app-pr
PR_ID=$(git config --get pullrequest.id)
PR_AUTHOR=$(git log -n 1 --pretty=format:'%an')
TAG="draft."$(git rev-parse HEAD)
printf "**NOT FOR PRODUCTION**\nPR: #${PR_ID}, by ${PR_AUTHOR}\nDeploy with: \`${TAG}\`" > ../artifacts/body
cd ..
set -e

echo "Removing unecessary files"
rm build-project/composer.lock
rm -rf build-project/node_modules
find . -name '.[^.]*' -prune -exec rm -rf {} +

echo "* Creating tar.gz"
tar -czf artifacts/demo.tar.gz -C build-project .