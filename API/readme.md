# OSRS Player Stats API (hack) #

#### Contents ####
1. [About](#about)
2. [Usage](#usage)
    - [Headers](#headers)
    - [`POST oauth/token`](#post-oauthtoken)
    - [`POST api/account/signup`](#post-apiaccountsignup)
    - [`POST api/account/login`](#post-apiaccountlogin)
    - [`GET api/account/user`](#get-apiaccountuser-lock)
    - [`GET api/account/logout`](#get-apiaccountlogout-lock)
    - [`GET api/playerStats`](#get-apiplayerstats)
    - [`POST api/playerLikes`](#post-apiplayerlikes-lock)
    - [`GET api/playerLikes`](#get-apiplayerlikes-lock)
    - [`POST api/playerComments`](#post-apiplayercomments-lock)
    - [`DELETE api/playerComments`](#delete-apiplayercomments-lock)
3. [Installation](#installation)
4. [Testing](#testing-phpunit)

## About ##

## Usage ##

### Headers ###

You will need to specify you want json using the header:
`Accept: application/json`.

For endpoints that require authentication (endpoints with :lock:) you will need to include the `Authorization` header with the users access token. The access token is given to the user when logged in. 

#### Example Headers ####
```
Accept: application/json,
Authorization: Bearer eyJ0eXAiOiJKV1Qi...
```

### POST `oauth/token` ###

This is the API request to setup the Oauth Client, this request is part of the installation of the API. You must make the request `POST api/account/signup` before you make your Oauth token as its part of the required form data. You must use settings from your `Oauth_clients` table. The Grant Client will always be the ID 2. You will need the Client ID and Secret from record 2. 

Once the successful request is made the necessary tokens will be created (access and refresh tokens).

<details><summary> View Form Data </summary>
<p>
    
- `grant_type`: Recommended: `password`
- `client_secret`: Recommended: Oauth grant secret from `Oauth_clients, id: 2 (Grant Client)`
- `client_id`: Recommended: `2`
- `username`: Username of User
- `password`: Password of User

#### Example ####
    
```
"grant_type" = "password",
"client_secret" = "MTWvDLmxmXgkWW6CEmPVWRrnvbfRFS9x1Z230VsX",
"client_id" = "2",
"username" = "bilbo@email.com",
"password" = "password123",
```
</p>
</details>
<details><summary> View Success Response </summary>
<p>
    
```
{
    "token_type": "Bearer",
    "expires_in": 31622400,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjlmZjNlYjc3ZDdhNjhlNzk4Y2JhODJkODkzMTE2YjJjN2UyZTUxOTA3OTZiMDE0OGIxYWI3ZjI2OTY5Y2IwYmFjZWY5YjliMDQyNzUzNTU1In0.eyJhdWQiOiIyIiwianRpIjoiOWZmM2ViNzdkN2E2OGU3OThjYmE4MmQ4OTMxMTZiMmM3ZTJlNTE5MDc5NmIwMTQ4YjFhYjdmMjY5NjljYjBiYWNlZjliOWIwNDI3NTM1NTUiLCJpYXQiOjE1NTQ4OTgxOTEsIm5iZiI6MTU1NDg5ODE5MSwiZXhwIjoxNTg2NTIwNTkxLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.rV2NgJSWGJIkeDdn_hzqZzK1Ky3u1zJTQL1y_cXU_txFglWnnwDb82SmxFSsHbVnxhLGdUIDMI7PR4dxggzkojVPQUxv6L61AG9FKgRYL8aC5tEE--gpap58ieA4AFmw8TLcOeTut_l48kLAq6_w84qCU2l50VtCxZGPHSzdEwOXJPNguvOdlT9z7VYRoMlyllavwxVEc7IU5le35et-Ihf5XHUaI5rB1HO_i_zCcA7026kDFO-vlwPuw61Hgfxwvrie0ChddUgrWhHpxTdd6QB1brSUSnPWJgwsRjiKAR3YUNgeEPez_OOAp9laoqepRjbihYms9d0QrL7CjDYhAH8IpZy222AVUKlurcBlz3zFWs421dYyu9vW8IlnfBDtAKY--Y_xeIa6MXsGa-khRA-Rz5lvCp4_qhhjvL0B0w3SAtZK43-QCJNTRdJfvnbtb2zMXUn_W_Em3QqZoBYldbMSOdrjp9H3uB3sZzmdCQoBSznLzhqIOzU-LdkidJCjwECvjfDi4niI1zHCrz5blUGeAd5_40dFXpuBVO4lUXOQafw-0tPinXfstb6IG6dJV29oecSISSqLsE95nSapqD1gRl-d_8K7ue8DfNkhQlQafm3dnLCx7YI8aN32Ncx_208S86Jfy0gvzLPmZ35Tw7q5dfSQeX45ey38omJGFlE",
    "refresh_token": "def50200434702205e7e1758c82fcc06d3b7576dd1fa4cdb220e38974a4797defbf87908d5776f1628c899d7b976a9d0142e00ba4fe2e8476bd04b046eafe79c41d21ed31fe88cd9e54521e7f44b78a94b1607a7b222e02ecc2c1acccf02e60c34b707aac29bfa3dc09c71c42d76af98d33f355bef1ff4277bdd231a7d5cf879dfdc62764c64f73800cb34c8d11aa9495d86fd76d4ab58c42e3ee58a46890d5384ec44a8deff758ba300fb60d8522d3e405998627d0531d5bcfd8aed092a2a628e4d44e078a12b0aad091139a59f1d1589a3fa917d7d4e5ff3e3c716c2d2ab390055631a3f83f76514f8f1c91d519c7b54f880d7d7fb1b560f033978b96149a4ef728fec42fd64e508ee3bb2e835382ada9d329350773b77b06516e9bef7705b04430e1626ffe9f0adf9436cb5f0c730d1bf66e71a0aa49755f3b5de30d5a82b193b12c9c6ee44fe4316e6926c0a2c8eb87eaa249cf4676d71d09fbc86c86fda32"
}
```
</p>
</details>

### POST `api/account/signup` ###

Registers user.

<details><summary> View Form Data </summary>
<p>
    
#### Example ####
    
```
"name" = "bilbo",
"email" = "bilbo@email.com",
"password" = "password123",
"password_confirmation" = "password123",
```
</p>
</details>
<details><summary> View Success Response </summary>
<p>
    
```
{
    "message": "Successfully created user!"
}
```
</p>
</details>

### POST `api/account/login` ###

Logs user in.

<details><summary> View Form Data </summary>
<p>
    
#### Example ####
    
```
"email" = "bilbo@email.com",
"password" = "password123",
```
</p>
</details>
<details><summary> View Success Response </summary>
<p>
    
```
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImViMWYxOWQ5NzE2MGZlOGY4N2RlZGU0YWUyOTVhMzNiZjQ1MTUzMGEzZDVkYzAzMjhjM2RmZjY3ZWRkMWIyNzhjOGE0ODBhMjRiZDk3M2YwIn0.eyJhdWQiOiIxIiwianRpIjoiZWIxZjE5ZDk3MTYwZmU4Zjg3ZGVkZTRhZTI5NWEzM2JmNDUxNTMwYTNkNWRjMDMyOGMzZGZmNjdlZGQxYjI3OGM4YTQ4MGEyNGJkOTczZjAiLCJpYXQiOjE1NTQ5MjU4MjcsIm5iZiI6MTU1NDkyNTgyNywiZXhwIjoxNTg2NTQ4MjI3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.xbMDyTCOSSop7MRPOO7qPUodhJP6ar-15pfr0auhknXbqSHNmjQz4r93khE7pM7I5R9VJOqVfoqkiKzzYoyX-1h4p5_4XTLeM5uuy7yrYt8h5wf5-XF6U7XwJika3Va2VLYY8z4fGnkH8WJFMOWzrpD-jUNDCJJuOKJcmCHD8cctnylCCWYIWXwRolTt3hp0P5Wkc4rV7FHFj5rGwTOCbNHbzM_KqXdJQvPr3kHsO18Lo0HRUqeDDIkQPr-WWSg2rloQj8UJ4szfNu7in-JE5eEC-Sm4dHu31wFZaycZU2tXHLUbntM7_I6QerFLCJEkl1C_sc8o0ACVW7v8gOJ5bRgTapAQLf7gjNizZ0RD14vdMAI2ckjgzse8YOLWqXEzIKALwG7VVGiIzmSNjKcIND9maDa4Hrk442KDflQ3XMnUhZvYMmOCGxBZt-k9ATOlPYzzczrbSk3PTMHbHKa18QM_8pL45vtO6f9hYJUmj2nbi3aBOMPXXug8BJQyan2NsLsTxjg3uXGzWulz_cxK5A5clE_FgFhk-BI9-B-VQc4ubEGIU4bfG9a7dSOTo4nSC5ttB-lEifjo8EMLtaiNncKItkTdC59-WIGib2wIrZJxKQde9BJOulJlZ_xAFiq6tmYBvOAbWg849r54vUicGUQyVvup_X5zvNhQhPEtAXQ",
    "token_type": "Bearer",
    "expires_at": "2020-04-10 19:50:27"
}
```
</p>
</details>

### GET `api/account/user` :lock: ###

Return current users information.

<details><summary> View Success Response </summary>
<p>
    
```
{
    "id": 1,
    "name": "bilbo",
    "email": "bilbo@email.com",
    "email_verified_at": null,
    "created_at": "2019-04-10 19:39:55",
    "updated_at": "2019-04-10 19:39:55"
}
```
</p>
</details>

### GET `api/account/logout` :lock: ###

Logs user out.

<details><summary> View Success Response </summary>
<p>
    
```
{
    "message": "Successfully logged out"
}
```
</p>
</details>

### GET `api/playerStats` ###

Returns OSRS stats for a account.

<details><summary> View Parameters </summary>
<p>
    
- `account_name`: (Name of OSRS account)

#### Example ####
    
```
/api/playerStats/frodo
```
</p>
</details>
<details><summary> View Success Response </summary>
<p>
    
```
{
    "username": "frodo",
    "stats": {
        "Overall": {
            "Rank": 1756468,
            "Level": 512,
            "XP": 5239539
        },
        "Attack": {
            "Rank": 1950344,
            "Level": 40,
            "XP": 38551
        },
        "Prayer": {
            "Rank": 1184297,
            "Level": 43,
            "XP": 53293
        },
        "Cooking": {
            "Rank": 1411141,
            "Level": 43,
            "XP": 54310
        },
        "Woodcutting": {
            "Rank": 794578,
            "Level": 61,
            "XP": 332119
        },
        "Fletching": {
            "Rank": 869188,
            "Level": 49,
            "XP": 97440
        },
        "Firemaking": {
            "Rank": 119739,
            "Level": 88,
            "XP": 4610557
        },
        "Herblore": {
            "Rank": 1837567,
            "Level": 1,
            "XP": 0
        },
        "Agility": {
            "Rank": 1539379,
            "Level": 30,
            "XP": 14155
        },
        "Thieving": {
            "Rank": 1612592,
            "Level": 15,
            "XP": 2559
        },
        "Slayer": {
            "Rank": 1793339,
            "Level": 4,
            "XP": 349
        },
        "Farming": {
            "Rank": 1612601,
            "Level": 1,
            "XP": 0
        },
        "Runecraft": {
            "Rank": 1715457,
            "Level": 1,
            "XP": 0
        },
        "Hunter": {
            "Rank": 1587180,
            "Level": 1,
            "XP": 0
        },
        "Construction": {
            "Rank": 1042296,
            "Level": 2,
            "XP": 172
        },
        "Defence": {
            "Rank": null,
            "Level": 0,
            "XP": 0
        },
        "Strength": {
            "Rank": null,
            "Level": 0,
            "XP": 0
        },
        "Hitpoints": {
            "Rank": null,
            "Level": 0,
            "XP": 0
        },
        "Ranged": {
            "Rank": null,
            "Level": 0,
            "XP": 0
        },
        "Magic": {
            "Rank": null,
            "Level": 0,
            "XP": 0
        },
        "Fishing": {
            "Rank": null,
            "Level": 0,
            "XP": 0
        },
        "Crafting": {
            "Rank": null,
            "Level": 0,
            "XP": 0
        },
        "Smithing": {
            "Rank": null,
            "Level": 0,
            "XP": 0
        },
        "Mining": {
            "Rank": null,
            "Level": 0,
            "XP": 0
        }
    },
    "likes": 2,
    "user_likes": false,
    "comments": [
        {
            "id": 2,
            "user_id": 1,
            "account_id": 2,
            "body": "Nice!",
            "likes": 0,
            "created_at": "2019-04-10 20:07:37",
            "updated_at": "2019-04-10 20:07:37"
        }
    ]
}
```
</p>
</details>

### POST `api/playerLikes` :lock: ###

<details><summary> View Form Data </summary>
<p>
    
- `account_name`: (Name of OSRS account)

#### Example ####

Likes or Unlikes OSRS account, depending if the account is already liked or not.

```
"account_name" = "Krun64",
```
</p>
</details>
<details><summary> View Success Response </summary>
<p>
    
```
{
    "message": "Player liked"
}
```
</p>
</details>

### GET `api/playerLikes` :lock: ###

Find out whether current user likes specified account.

<details><summary> View Parameters </summary>
<p>
    
- `account_name`: (Name of OSRS account)

#### Example ####

Find out if user currently likes specified user.
    
```
/api/playerLikes/frodo
```
</p>
</details>
<details><summary> View Success Response </summary>
<p>
    
```
{
    "liked": true
}
```
</p>
</details>

### POST `api/playerComments` :lock: ###

Post comment for an account.

<details><summary> View Form Data </summary>
<p>
    
- `body`: Large text
- `account_name`: (Name of OSRS account)

#### Example ####
    
```
"body" = "This is the comment",
"account_name" = "frodo"
```
</p>
</details>
<details><summary> View Success Response </summary>
<p>
    
```
{
    "message": "Comment posted"
}
```
</p>
</details>

### DELETE `api/playerComments` :lock: ###

<details><summary> View Parameters </summary>
<p>
    
- `comment_id`: (ID of comment)

#### Example ####

Delete a comment.
    
```
/api/playerComments/1
```
</p>
</details>
<details><summary> View Success Response </summary>
<p>
    
```
{
    "message": "Comment deleted"
}
```
</p>
</details>

## Installation ##
1. Clone repository 
2. In the terminal, run `Composer Install` to install dependencies
3. Set up DB, configure DB mysql settings in .env (Host, Username, Password)
4. In the terminal, run `php artisan migrate` to run DB migrations
5. In the terminal, run `php artisan passport:install` to install Laravel Passport and generate a client 
6. Follow API endpoint: `POST api/oauth/token` to setup Oauth Client
7. Make requests!

## Testing (phpunit) ##
1. Run `vendor/bin/phpunit` in the Terminal
Alternatively to create an alias in the Terminal (API Directory):
2. Run `alias test="vendor/bin/phpunit"` to create an alias
3. Run `test` to run feature and unit tests
