<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/home_style.css') }}">

<title>The Queen's Clinic</title>
<style>

body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f2f2f2;
}

.container {
  width: 300px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  padding: 20px;
}

h2 {
  margin-bottom: 20px;
  text-align: center;
}

input[type="email"],
input[type="submit"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

input[type="submit"] {
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #0056b3;
}

@media only screen and (max-width: 400px) {
  .container {
    width: 90%;
  }
}

.zxcv{
    
}

</style>
</head>
<body>

<div class="container">
    
  <h2>Forgot Password?</h2>
  <p class="zxcv">Enter the email address associated with your account. We'll send you a link to reset your password.</p><br>
    <form action="#" method="post">
    <input type="email" name="email" placeholder="Enter your email" required>
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
