#### Создание/редактирование пользователя
```json
POST http://{ip}/user/save

{
    "id": 1, -- null создать, не null редактировать
    "firstName": "tes",
    "LastName": "test",
    "patronymic": "test",
    "email": "test@yandex.ru",
    "phoneNumber": "892374829",
    "hasPassword": "123",
    "role": {
        "id": 5
    }
}
```
#### Получить всех или одного пользователя
```json
POST http://{ip}/user/get

{
    "id": 1, -- null получить всё, не null получить одного
}
```

#### Получить все роли
```json
GET http://{ip}/role/get
```