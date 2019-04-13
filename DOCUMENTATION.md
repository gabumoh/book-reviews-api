FORMAT: 1A
HOST: http://142.93.83.198/api/

# Book Review Api

This is a simple API allowing consumers to view books and their ratings. This API also allows users add books and edit the books which they added.

# Group Manage Users

## Registration Endpoint [/register]

### Register a new User [POST]

This is the endpoint responsible for registering new users and authenticates the newly registered user

+ Request (application/json)

        {
            "name": "John Doe",
            "email": "john@test.com",
            "password": "password"
        }
        
+ Response 200 (application/json)

        {
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9yZWdpc3RlciIsImlhdCI6MTUzNzEyNTM3OSwiZXhwIjoxNTM3MTI4OTc5LCJuYmYiOjE1MzcxMjUzNzksImp0aSI6IkVEazJITXdwNkI0VnJHZ1QiLCJzdWIiOjIzLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.tXvV8WQNvWJU8fDlVkqKs3mj4BMg2zdGyKQEr1IK8CI",
            "token_type": "bearer",
            "expires_in": 3600
        }
        
## Login Endpoint [/login]

### Existing user login [POST]

This is the endpoint that enables existing users login and get their access token.

+ Request (application/json)

        {
            "email": "john@test.com",
            "password": "password"
        }
        
+ Response 200 (application/json)

        {
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTUzNzEyNjI1NywiZXhwIjoxNTM3MTI5ODU3LCJuYmYiOjE1MzcxMjYyNTcsImp0aSI6IlpXeklpYXhwaTM1WFpsNVciLCJzdWIiOjIzLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.sK7m_JOd3odbQ27p8L2Q10P8BPuaCdltNnKsi4626ug",
            "token_type": "bearer",
            "expires_in": 3600
        }

# Group Manage Books

## Books API Endpoints [/books]

### List All Books [GET]

This endpoint displays all the books that are present in the database, it is paginated to show only 25 entries per page.

+ Response 200 (application/json)

        {
            "data": [
                {
                    "id": 1,
                    "title": "Narnia",
                    "description": "A book of Fairytales",
                    "average_rating": 5,
                    "created_at": "2017-07-09 19:29:18",
                    "updated_at": "2017-07-09 19:29:18",
                    "user": {
                        "id": 1,
                        "name": "John",
                        "email": "john@example.com",
                        "created_at": "2017-07-09 19:29:18",
                        "updated_at": "2017-07-09 19:29:18",
                    },
                    "ratings": [
                        {
                            "id": 1,
                            "user_id": 10,
                            "rating": 5,
                            "created_at": "2017-07-09 19:29:18",
                            "updated_at": "2017-07-09 19:29:18",
                        },
                        {
                            "id": 1,
                            "user_id": 54,
                            "rating": 5,
                            "created_at": "2017-07-09 19:29:18",
                            "updated_at": "2017-07-09 19:29:18",
                        },
                    ]
                },
                {
                    "id": 26,
                    "title": "The Lion King",
                    "description": "Simba, look what you have done",
                    "average_rating": 5,
                    "created_at": "2017-07-09 19:29:18",
                    "updated_at": "2017-07-09 19:29:18",
                    "user": {
                        "id": 1,
                        "name": "John",
                        "email": "john@example.com",
                        "created_at": "2017-07-09 19:29:18",
                        "updated_at": "2017-07-09 19:29:18",
                    },
                    "ratings": [
                        {
                            "id": 1,
                            "user_id": 19,
                            "rating": 5,
                            "created_at": "2017-07-09 19:29:18",
                            "updated_at": "2017-07-09 19:29:18",
                        },
                        {
                            "id": 1,
                            "user_id": 4,
                            "rating": 5,
                            "created_at": "2017-07-09 19:29:18",
                            "updated_at": "2017-07-09 19:29:18",
                        },
                    ]
                }
            ],
            "links": {
                "first": "http://142.93.83.198/api/books?page=1",
                "last": "http://142.93.83.198/api/books?page=1",
                "prev": null,
                "next": null
            },
            "meta": {
                "current_page": 1,
                "from": 1,
                "last_page": 1,
                "path": "http://142.93.83.198/api/books",
                "per_page": 25,
                "to": 2,
                "total":2
            }
        }

### Create a New Book [POST]

You may add your own books using this action. It takes a JSON
object containing a title and a description.

+ Request (application/json)

    + Headers
    
            Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTUzNzEyNjI1NywiZXhwIjoxNTM3MTI5ODU3LCJuYmYiOjE1MzcxMjYyNTcsImp0aSI6IlpXeklpYXhwaTM1WFpsNVciLCJzdWIiOjIzLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.sK7m_JOd3odbQ27p8L2Q10P8BPuaCdltNnKsi4626ug
            
    + Body

            {
                "title": "Girl Nextdoor",
                "description": "Neighborly secrets"
            }
        

+ Response 201 (application/json)

    + Headers

            Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTUzNzEyNjI1NywiZXhwIjoxNTM3MTI5ODU3LCJuYmYiOjE1MzcxMjYyNTcsImp0aSI6IlpXeklpYXhwaTM1WFpsNVciLCJzdWIiOjIzLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.sK7m_JOd3odbQ27p8L2Q10P8BPuaCdltNnKsi4626ug

    + Body

            {
                "data": {
                    "id": 4,
                    "title": "Girl Nextdoor",
                    "description": "Neighborly secrets",
                    "average_rating": null,
                    "created_at": "2017-07-09 19:29:18",
                    "updated_at": "2017-07-09 19:29:18",
                    "user": {
                        "id": 1,
                        "name": "John",
                        "email": "john@example.com",
                        "created_at": "2017-07-09 19:29:18",
                        "updated_at": "2017-07-09 19:29:18",
                    },
                    "ratings": []
                }
            }

## View, Modify, and Delete Book API Endpoint [/books/{book}]

### Show a single Book [GET]

This endpoint would list the details of a single book such as the title, description, and all the ratings asscociated with the book. This can be achieved by adding the book id trailing the url.

+ Response 200 (application/json)

            {
                "data": [
                {
                    "id": 1,
                    "title": "Narnia",
                    "description": "A book of Fairytales",
                    "average_rating": 5,
                    "created_at": "2017-07-09 19:29:18",
                    "updated_at": "2017-07-09 19:29:18",
                    "user": {
                        "id": 1,
                        "name": "John",
                        "email": "john@example.com",
                        "created_at": "2017-07-09 19:29:18",
                        "updated_at": "2017-07-09 19:29:18",
                    },
                    "ratings": [
                        {
                            "id": 1,
                            "user_id": 10,
                            "rating": 5,
                            "created_at": "2017-07-09 19:29:18",
                            "updated_at": "2017-07-09 19:29:18",
                        },
                        {
                            "id": 1,
                            "user_id": 54,
                            "rating": 5,
                            "created_at": "2017-07-09 19:29:18",
                            "updated_at": "2017-07-09 19:29:18",
                        },
                    ]
                }
            }
            
### Edit a book [PUT]

This endpoint enables a user which added a book to edit the book, bare in mind that the title and descriptions are required fields with the token added as the authorization header.

+ Request (application/json)
        
    + Headers
    
            Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTUzNzEyNjI1NywiZXhwIjoxNTM3MTI5ODU3LCJuYmYiOjE1MzcxMjYyNTcsImp0aSI6IlpXeklpYXhwaTM1WFpsNVciLCJzdWIiOjIzLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.sK7m_JOd3odbQ27p8L2Q10P8BPuaCdltNnKsi4626ug
            
    + Body
    
            {
                "title": "Narnia",
                "description": "A book with fairytales"
            }
            
+ Response 200 (application/json)

    + Headers
    
            Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTUzNzEyNjI1NywiZXhwIjoxNTM3MTI5ODU3LCJuYmYiOjE1MzcxMjYyNTcsImp0aSI6IlpXeklpYXhwaTM1WFpsNVciLCJzdWIiOjIzLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.sK7m_JOd3odbQ27p8L2Q10P8BPuaCdltNnKsi4626ug
    
    + Body
    
            {
                "data": [
                {
                    "id": 1,
                    "title": "Narnia",
                    "description": "A book with fairytales",
                    "average_rating": 5,
                    "created_at": "2017-07-09 19:29:18",
                    "updated_at": "2017-07-09 19:29:18",
                    "user": {
                        "id": 1,
                        "name": "John",
                        "email": "john@example.com",
                        "created_at": "2017-07-09 19:29:18",
                        "updated_at": "2017-07-09 19:29:18",
                    },
                    "ratings": [
                        {
                            "id": 1,
                            "user_id": 10,
                            "rating": 5,
                            "created_at": "2017-07-09 19:29:18",
                            "updated_at": "2017-07-09 19:29:18",
                        },
                        {
                            "id": 1,
                            "user_id": 54,
                            "rating": 5,
                            "created_at": "2017-07-09 19:29:18",
                            "updated_at": "2017-07-09 19:29:18",
                        },
                    ]
                }
            }
            
### Delete a Book [DELETE]

Using the delete method with the book id trailing the url, the user which created the book would be able to delete the book.

+ Request (application/json)

    + Headers
    
            Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTUzNzEyNjI1NywiZXhwIjoxNTM3MTI5ODU3LCJuYmYiOjE1MzcxMjYyNTcsImp0aSI6IlpXeklpYXhwaTM1WFpsNVciLCJzdWIiOjIzLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.sK7m_JOd3odbQ27p8L2Q10P8BPuaCdltNnKsi4626ug

+ Response 200 (application/json)

    + Headers
    
            Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTUzNzEyNjI1NywiZXhwIjoxNTM3MTI5ODU3LCJuYmYiOjE1MzcxMjYyNTcsImp0aSI6IlpXeklpYXhwaTM1WFpsNVciLCJzdWIiOjIzLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.sK7m_JOd3odbQ27p8L2Q10P8BPuaCdltNnKsi4626ug
          
          
    + Body
            
            "Delete Successful"
            
            
# Group Ratings

## Add ratings on a Book API Endpoint [/books/{book}/ratings]

### New Rating [POST]

This endpoint accepts only the value rating as an integer, alongside authorization headers for users

+ Request (application/json)

    + Headers
    
            Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTUzNzEyNjI1NywiZXhwIjoxNTM3MTI5ODU3LCJuYmYiOjE1MzcxMjYyNTcsImp0aSI6IlpXeklpYXhwaTM1WFpsNVciLCJzdWIiOjIzLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.sK7m_JOd3odbQ27p8L2Q10P8BPuaCdltNnKsi4626ug
    
    + Body
    
            {
                "rating": 5
            }
            
+ Response 200 (application/json)

    + Headers
    
            Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTUzNzEyNjI1NywiZXhwIjoxNTM3MTI5ODU3LCJuYmYiOjE1MzcxMjYyNTcsImp0aSI6IlpXeklpYXhwaTM1WFpsNVciLCJzdWIiOjIzLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.sK7m_JOd3odbQ27p8L2Q10P8BPuaCdltNnKsi4626ug
            
    + Body
    
            {
                "data": {
                    "user_id": 14,
                    "book_id": 1,
                    "rating": 5,
                    "created_at": "2018-09-16 15:55:13",
                    "updated_at": "2018-09-16 15:55:13",
                    "book": {
                        "id": 1,
                        "user_id": 12,
                        "title": "Narnia",
                        "description": "A book with fairytales",
                        "created_at": "2018-07-09 19:29:18",
                        "updated_at": "2018-09-16 13:48:06"
                    }
                }
            }