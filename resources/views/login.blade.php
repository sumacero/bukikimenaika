<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
<p>{{$message}}</p>
<form action="/login" method="post">
    @csrf
    <label>mail<input type="text" name="email"></label>
    <label>password<input type="text" name="password"></label>
    <input type="submit" value="submit"></label>
</form>
</body>
</html>





