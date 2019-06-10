<?php

use app\engine\Authentication;

$this->title = "Страница отладки";


echo "<h3>Authentication</h3>";

$auth = new Authentication();
$password = $auth->passwordHash('ruslan');
echo $password . '<br>';
if (isset($_POST['login'])){
    $auth->userAuth();
}
?>

<form method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">login</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter
        email" name="login">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
