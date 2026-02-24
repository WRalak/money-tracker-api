
#!/bin/bash

echo "==================================="
echo "COMPLETE MONEY TRACKER API TEST"
echo "==================================="

echo -e "\n1️⃣  Testing server connection..."
curl -s -o /dev/null -w "✅ Server response: %{http_code}\n" http://127.0.0.1:8000

echo -e "\n2️⃣  Creating a new user (POST)..."
curl -s -X POST http://127.0.0.1:8000/api/users \
  -H "Content-Type: application/json" \
  -d '{"name":"John Smith","email":"john.smith@example.com"}' | json_pp

echo -e "\n3️⃣  Creating a wallet (POST)..."
curl -s -X POST http://127.0.0.1:8000/api/wallets \
  -H "Content-Type: application/json" \
  -d '{"user_id":1,"name":"Main Wallet","description":"Primary account"}' | json_pp

echo -e "\n4️⃣  Adding income transaction (POST)..."
curl -s -X POST http://127.0.0.1:8000/api/transactions \
  -H "Content-Type: application/json" \
  -d '{"wallet_id":1,"amount":1500.00,"type":"income","description":"Monthly salary"}' | json_pp

echo -e "\n5️⃣  Adding expense transaction (POST)..."
curl -s -X POST http://127.0.0.1:8000/api/transactions \
  -H "Content-Type: application/json" \
  -d '{"wallet_id":1,"amount":300.00,"type":"expense","description":"Groceries"}' | json_pp

echo -e "\n6️⃣  Getting user profile (GET)..."
curl -s http://127.0.0.1:8000/api/users/1 | json_pp

echo -e "\n7️⃣  Getting wallet details (GET)..."
curl -s http://127.0.0.1:8000/api/wallets/1 | json_pp

echo -e "\n==================================="
echo "✅ TEST COMPLETE - If all POST requests worked, you're good!"
echo "==================================="



