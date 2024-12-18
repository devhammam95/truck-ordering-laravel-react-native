<h1 align="center">
Laravel with React Native 
</h1>
<div align="center">
  <img src="./react-native/assets/login.png" alt="login for app" height="425">
  <img src="./react-native/assets/register.png" alt="Register for app" height="425">
    <img src="./react-native/assets/dashboard.png" alt="Home " height="425">
    <img src="./react-native/assets/view-shipping-order.png" alt="View shipping orders.png" height="425">
    <img src="./react-native/assets/request-shipping-order.png" alt="request-shipping-order.png" height="425">
</div>
<hr>

## About Task
- Create simple truck shipping ordering in laravel & react-native

## Installation by docker for laravel:
- Run `make setup` and app will start setup
- Run `make start` to run all services inside docker-compose
- Run `make run-tests` to run tests for the app

## Installation for react-native app:
- Run `npm i`
- Run `npx react-native run-android`
- Note: Gradle caches can sometimes cause issues with Kotlin compilation, to fix it clean the build and restart the build process: 
- Run `npx react-native clean`, `cd android && ./gradlew clean` then `npx react-native run-android`

# Usage
- Run `make setup` and app will start setup
- Your host api will be `http://localhost:8005`
- To connect to mysql data, do these configurations:
  (host=127.0.0.1, port=3307, database=truck_ordering_db, user=test_truck_ordering_user, password=5Efa;j3J8QNa4`j5)

## Used Technologies
- docker
- PHP8.3
- Laravel
- mysql
- nginx
- react-native

## About code & architecture
- Versioning the API.
- Followed the PHP Standard Recommendations **PSR**.
- Make the code as modularity inside modules directory.

## Notes
- I run the app on mac `m1 pro chip` so I did some extra configurations for mac in `docker-compose.yml`, if you face blockers in running app, plz let me know
- If env variable values aren't appeared in postman collection,
  import the exported environment, I attached exported postman collection in laravel project root.
