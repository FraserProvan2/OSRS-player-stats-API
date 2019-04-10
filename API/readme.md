# OSRS Player Stats API (hack) #

#### Contents ####
1. About(#about)
2. Usage(##usage)
    - [`POST oauth/token`](#post-oauthtoken)
    - [`POST api/account/signup`](#post-apiaccountsignup)
    - [`POST api/account/login`](#post-apiaccountlogin)
    - [`GET api/account/user`](#get-apiaccountuser)
    - [`GET api/account/logout`](#get-apiaccountlogout)
    - [`GET api/playerStats`](#get-apiplayerstats)
    - [`POST api/playerLikes`](#post-apiplayerlikes)
    - [`GET api/playerLikes`](#get-apiplayerlikes)
    - [`GET api/playerComments`](#get-apiplayercomments)
    - [`POST api/playerComments`](#POST-apiplayercomments)
    - [`DELETE api/playerComments`](#delete-apiplayercomments)
3. Installation(#installation)
4. Testing(#testing-phpunit)

## About ##

## Usage ##

### POST `oauth/token` ###

This is the API request to setup the Oauth Client, this request is part of the installation of the API. You must use settings from your `Oauth_clients` table. The Grant Client will always be ID. You will need the Client ID and Secret from record 2. 

Once the successful request is made the necessary tokens will be created (access and refresh tokens).

<details><summary> View Form Data </summary>
<p>
    
- `grant_type`: Password
- `client_secret`: Oauth grant secret from `Oauth_clients, id: 2 (Grant Client)`
- `client_id`: 2 `(Grant Client)`
- `username`: Username of User
- `password`: Password of User

#### Example ####
    
```
"grant_type" = "password",
"client_secret" = "MTWvDLmxmXgkWW6CEmPVWRrnvbfRFS9x1Z230VsX",
"client_id" = "2",
"username" = "fraser@email.com",
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

### POST `api/account/login` ###

### GET `api/account/user` ###

### GET `api/account/logout` ###

### GET `api/playerStats` ###

### POST `api/playerLikes` ###

### GET `api/playerLikes` ###

### GET `api/playerComments` ###

### POST `api/playerComments` ###

### DELETE `api/playerComments` ###

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
