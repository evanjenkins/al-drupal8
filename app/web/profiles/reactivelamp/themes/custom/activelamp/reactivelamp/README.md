Activelamp.com installation using docker4drupal and profiled with a React Frontend. 

## Requirements
1. **Install Docker**
2. **Install Node**

## Setup
1. Clone the repository
2. **Initial Machine Setup**. run `docker-sync start --foreground`
3. **Docker**. then `docker-compose up -d`
4. **Let it do it's thing**.
5. `cd app` and `composer install`

## Running application
1. App should now be visible at [http://activelamp.docker.localhost:8000](http://activelamp.docker.localhost:8000)
2. Install the profile.
3. Devel generate some content.

## Subtree: React Frontend

The `app/web/profiles/reactivelamp/themes/custom/activelamp/reactivelamp` is a subtree. To contribute:

1. Fork https://github.com/activelamp/reactivelamp. Add remotes:
  
  ```sh
  $ git remote add frontend-upstream git@github.com:activelamp/reactivelamp.git
  $ git remote add frontend-origin git@github.com:<YOUR USERNAME>/reactivelamp.git
  ```
  
2. To update the sub-project repo:
  
  ```sh
  $ git fetch frontend-upstream
  $ git subtree pull --prefix app/web/profiles/reactivelamp/themes/custom/activelamp/reactivelamp master --squash
  ```
  
3. To push subtree changes upstream to your fork:
  
  ```sh
  $ git subtree push --prefix app/web/profiles/reactivelamp/themes/custom/activelamp/reactivelamp master --squash
  ```
  
## React Frontend

1. `npm install` within the reactivelamp subtree.
2. `npm start -s` to start up the frontend.