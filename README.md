
Request to get your first access token
===

````
/oauth/v2/token?client_id=<client_id>&client_secret=<client_secret>&grant_type=password&username=<username>&password=<password>
````

### Request parameters

````
client_id:          <your client id>
client_secret:      <your client secret>
grant_type:         password
username:           <your username>
password:           <your password>
````

Request to refresh token
===

````
/oauth/v2/token?grant_type=refresh_token&refresh_token=<refresh_token>&client_id=<client_id>&client_secret=<client_secret>
````

### Request parameters

````
client_id:          <your client id>
client_secret:      <your client secret>
grant_type:         refresh_token
refresh_token:      <your refresh token>
````

JSON Response for any request type
===

````
{
    "access_token": "xxxxxxxxx",
    "expires_in": 84600,
    "token_type": "bearer",
    "scope": null,
    "refresh_token": "xxxxxxxxx"
}
````

### Request API

In your api queries, specify in the header 'Authorization' type 'Bearer' and the value of the token provided
