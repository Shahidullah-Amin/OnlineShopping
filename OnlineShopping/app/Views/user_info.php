<?= $this->extend('templates/base.php') ?>

<?= $this->section('content') ?>

<?php

echo "<h1>{$username}</h1></br>";
echo "<h1>{$email}</h1></br>";
echo "<h1>{$password}</h1></br>";
echo "<h1>{$_POST['password-confirm']}</h1></br>";


?>


<?= $this->endSection()?>