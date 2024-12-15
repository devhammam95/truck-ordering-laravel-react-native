## About Task
- Create simple truck shippig ordering in laravel & react-native

## Installation by docker for laravel:
- Run `make setup` and app will start setup
- Run `make start` to run all services inside docker-compose
- Run `make run-tests` to run tests for the app

# Usage
- Run `make setup` and app will start setup
- Your host api will be `http://localhost:8005`
- To connect to mysql data, do these configurations:
  (host=127.0.0.1, port=3307, database=truck_ordering_db, user=test_truck_ordering_user, password=5Efa;j3J8QNa4`j5)

## Used Technologies
- docker
- PHP8.0
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
