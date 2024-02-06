<?php $this->layout('master', ['title' => 'Register']) ?>

<h1>Register</h1>

<form action="" method="post">
    <input type="text" placeholder="Coloque seu usuario" name="username"> <br/><br/>
    <input type="text" placeholder="Coloque seu Nome" name="name"> <br/><br/>
    <input type="email" placeholder="email@email.com" name="email"><br/><br/>
    <input type="password" placeholder="Coloque sua Senha" name="password"><br/><br/>
    <input type="submit" placeholder="SUBMIT">
</form>
<br>
<a href="/login">Voltar</a>