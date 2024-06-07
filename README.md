# Installation

Run command `composer require laravel/sanctum`

# Publish configuration and migration files

Run command `php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"`

# Setup database

Don't forget the configuration files `.env`

# Trait

Ideally, the API will provide a response to every request it receives. We can create traits for API Response that are reusable. So we don't need to write code for the same response many times.

1. Create a folder named `Trait` in the Laravel project `app` folder
2. Create a file called `HttpResponses.php` (file name can be arbitrary)
3. Coding trait:

```php
<?php

// define namespace according to folder
namespace App\Trait;

// trait names are the same as file names
trait HttpResponse {
    protected function success($data, $message = null, $statusCode = 200) {
        return response()->json([
            "status" => "OK!",
            "message" => $message,
            "data" => $data
        ], $statusCode); // status code as second argument
    }

    protected function error($data, $message = null, $statusCode) {
        return response()->json([
            "status" => "ERROR!",
            "message" => $message,
            "data" => $data
        ], $statusCode); // status code as second argument
    }
}
```

# Create a Controller

Now we create an `AuthController` controller with the command `php artisan make:controller AuthController`, and use the `HttpResponses` trait in the controller.

```php
<?php

namespace App\Http\Controllers;

use App\Trait\HttpResponses; // use trait
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses; // use trait
}
```

# Setup Postman

Please setup Postman yourself. Create a workspace, collection, and so on.

# Routing

When creating an API in Laravel, ideally we route it in the `routes/api.php` file. Later, each route that is part of the API will have the prefix `/api`. For example, if there is a login route, the endpoint is `/api/login`.

Please open the `routes/api.php` file, and we create 1 POST route:

```php
Route::post("/login", [AuthController::class, "login"]);
```

From the code above, understand that we will use the `login` method in the `AuthController` controller. We don't need to write the prefix `/api` as the endpoint because it is done automatically.

# Run Server

Run command `php artisan serve`.

# Testing via Postman

Please send a POST request via Postman to the Laravel server address. Remember, the endpoint starts with `/api`.

# Membuat Response dari Controller

Previously, we created a trait as a response from our API. Use this trait in our controller. Here's an example:

```php
namespace App\Http\Controllers;

use App\Trait\HttpResponses; // use trait
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses; // use trait

    public function register() {
        return $this->success([
            "id" => 1
        ], "Registered!", 200);
    }
}
```

Note: `$this` refers to the `AuthController` class. `success()` is the method we use from the `HttpResponses` trait.

# Register API implementation

1. We create a Request by running the command `php artisan make:request StoreUserRequest`. Then a folder called `Requests` will be created in the `app/Http` folder, and all Request files will be saved in the `Requests` folder.

2. What is the use of the file? To create rules for validating requests given by users. Implement the code in the `rules()` method:

```php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => ['required', 'string', 'min:5', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            "email" => ['required', 'string', 'email', 'max:255', 'unique:users'],
            "password" => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/', // at least one uppercase letter
                'regex:/[a-z]/', // at least one lowercase letter
                'regex:/[0-9]/', // at least one digit
                'regex:/[@$!%*#?&]/', // at least one special character
                'confirmed'
            ],
        ];
    }
}
```

Note: **Don't forget to return `true` in the `authorize()` method**

3. Validate the `register()` method in `AuthController`:

```php
public function register(RegisterUserRequest $request) {
    $request->validated($request->all());

    // ...
}
```

4. After successful validation, create data into the database as well as create a token for registered users. This token will also be included in our API response.

```php
public function register(StoreUserRequest $request) {
    $request->validated($request->all());

    $user = User::create([
        "name" => $request->name,
        "email" => $request->email,
        "password" => Hash::make($request->password)
    ]);

    return $this->success([
        "user" => $user,
        "token" => $user->createToken("API Token of " . $user->name)->plainTextToken
    ], "Registered!", 200);
}
```

Note: `createToken()` useful for generating tokens for users, and the `plainTextToken` property is useful for providing plain tokens in the API response, not in the form of hashed tokens.

Note: The argument in the `createToken` method is needed to provide the name of the token in the database.

5. Testing Request API via Postman

Use the following two request headers:

`Accept`: `application/vnd.api+json`

`Content-Type`: `application/vnd.api+json`

Additionally, send `name`, `email`, `password`, and `password_confirmation` data via the raw request body.

```
{
    "name": "Alif Radifan Piandy",
    "email": "alif@gmail.com",
    "password": "V!ki120803",
    "password_confirmation": "V!ki120803"
}
```

After successfully making a request via Postman, our API will provide a response:

```
{
    "status": "OK!",
    "message": "Registered!",
    "data": {
        "user": {
            "name": "Alif Radifan Piandy",
            "email": "alif@gmail.com",
            "updated_at": "2024-03-06T16:03:31.000000Z",
            "created_at": "2024-03-06T16:03:31.000000Z",
            "id": 1
        },
        "token": "1|JCozWksb2U0bGv5Ufizl7GEJtEFZ4r2lmTFcPrHz5ff9af85"
    }
}
```

The token from the user will be stored in the `personal_access_tokens` table in our database.
