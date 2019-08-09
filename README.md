# PHP PHONE BOOK

## Supported methods

* GET
* POST
* PUT
* DELETE

## Usage:

### Create a new contact:

* Method: POST
* Url: http://localhost/test/rest_api/contacts.php
* Payload:

```
{
    "firstName": "Daniel",
    "surName": "Candia Flores",
    "information": [
        {
            "email": "danfercf@gmail.com",
            "phoneNumber": "59175963112"
        },
        {
            "email": "danfercf@hotmail.com",
            "phoneNumber": "59144666074"
        }
    ]
}
```

Response:

```
{
    "status": "1",
    "message": "success",
    "result": "Contact added successfully"
}
```

### Get all contacts:

* Method: GET
* Url: http://localhost/test/rest_api/contacts.php
* Response:

```
{
    {
        "status": "1",
        "message": "success",
        "result": [
            {
                "id": 14,
                "firstName": "fernando",
                "surNames": "flores",
                "information": [
                    {
                        "email": "fernando@gmail.com",
                        "phone_number": "77777777"
                    },
                    {
                        "email": "fer@gmail.com",
                        "phone_number": "12345678"
                    }
                ]
            },
            {
                "id": 15,
                "firstName": "Daniel",
                "surNames": "Candia Flores",
                "information": [
                    {
                        "email": "danfercf@gmail.com",
                        "phone_number": "59175963112"
                    },
                    {
                        "email": "danfercf@hotmail.com",
                        "phone_number": "59144666074"
                    }
                ]
            }
        ]
    }
}
```

### Get contact by id:

* Method: GET
* Url: http://localhost/test/rest_api/contacts.php?id=15
* Response:

```
{
    "status": "1",
    "message": "success",
    "result": [
        {
            "id": 15,
            "firstName": "Daniel",
            "surNames": "Candia Flores",
            "information": [
                {
                    "email": "danfercf@gmail.com",
                    "phone_number": "59175963112"
                },
                {
                    "email": "danfercf@hotmail.com",
                    "phone_number": "59144666074"
                }
            ]
        }
    ]
}
```

### Update a contact:

* Method: PUT
* Url: http://localhost/test/rest_api/contacts.php?id=15
* Payload:

```
{
    "firstName": "Daniel Fernando",
    "surName": "Candia Flores",
    "information": [
        {
            "email": "danfercf1@gmail.com",
            "phoneNumber": "59175963112"
        },
        {
            "email": "danfercf@hotmail.com",
            "phoneNumber": "59144666074"
        }
    ]
}
```

* Response:

```
{
    "status": "1",
    "message": "success",
    "result": "Contact updated successfully"
}
```

### Delete a contact:

* Method: DELETE
* Url: http://localhost/test/rest_api/contacts.php?id=12
* Response:

```
{
    "status": "1",
    "message": "success",
    "result": "Contact deleted successfully"
}
```