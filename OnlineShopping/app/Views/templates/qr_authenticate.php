<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div style="display: flex; justify-content:center;" >

        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="<?=$qr_code?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">User Authentication</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

            <form action="<?= site_url('/') ?>" method="POST" >
                <div class="form-group">
                    <input type="text" style="border-radius: 0%;" name="user-authentication-code" placeholder="Authentication Code" class="form-control">
                </div>
                <div class="form-group" style="margin-top:1rem;display: flex; justify-content:center;">
                    <button class="btn btn-outline-dark" style="border-radius: 0%;" type="submit">Authenticate</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>