1. docker-compose up --build -d
2. docker exec cs-test bash -c "composer start" (seed közben már feltölti 10 user-el az api-bol)
3. docker exec cs-test bash -c "php artisan fetch:user {quantity=10}" (a quantity opcionális, alap értéke 10)

phpmyadmin: http://localhost:8081