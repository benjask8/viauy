<h1>Registrese Como Compañia En Viauy!</h1>


<p>data: <?= $this->datos?></p>

<form action="index.php?c=company&m=doSignup" method="post">
    <input type="text" name="token" placeholder="#Token">
    <input type="mail" name="email" placeholder="email">
    <input type="text" name="name" placeholder="name">
    <input type="password" name="password" placeholder="password">
    <input type="password" name="passwordC" placeholder="password">

    <input type="submit" value="Registrarse">
</form>