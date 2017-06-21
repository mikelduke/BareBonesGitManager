# BareBonesGitManager
Super simple PHP Scripts for creating basic git repos.

## Features
* Creates git repositories

### Coming soon
* List repos
* Show Branches


## To Install
1. Copy the scripts to your php server

   Example path: /var/www/html/gitManager

2. Set the paths in gitManagerConfig.php

   Example paths: $_gitRepoPath = "~/git/"; or /var/www/html/git/

   This sets the folder to hold the git repos created by the script. The repos will 
   be created by the same user the php scripts run as, typically www-data or your username
   if you are on a shared host.

3. Set the prefix used for cloning:

   Example prefix: $_gitClonePrefix = "ssh://user@something/";

   This will create a clone command of "git clone ssh://user@something/[gitRepoPath]/[repoName]"

4. Secure the php scripts

   You can secure the php app using an apache .htaccess file

## Sample .htaccess file
```
AuthName "Dialog prompt"
AuthType Basic
AuthUserFile /somefolder/.htpasswd
Require valid-user

Options -Indexes
```

Create .htpasswd from bash: `htpasswd -c /somefolder/.htpasswd username`
