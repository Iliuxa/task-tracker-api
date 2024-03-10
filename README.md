#### Создание/редактирование пользователя
```POST http://{ip}/user/save```
```json
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
```POST http://{ip}/user/get```
```json
{
    "id": 1, -- null получить всё, не null получить одного
}
```

#### Получить все роли
```
GET http://{ip}/role/get
```

#### Авторизироваться
```
POST http://{ip}/login/authorization
```