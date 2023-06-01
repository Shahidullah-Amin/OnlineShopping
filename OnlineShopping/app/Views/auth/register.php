<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Sign Up</title>
</head>

<body>
    <div class="container">
        <section style='padding:2rem; padding-top:1mm;'>
            <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%); border-radius:10mm;">
                <div class="container">
                    <div class="row gx-lg-5 align-items-center">
                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <h1 class="my-5 display-3 fw-bold ls-tight">
                                The best offer <br />
                                <span class="text-primary">for your business</span>
                            </h1>
                            <p style="color: hsl(217, 10%, 50.8%)">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Eveniet, itaque accusantium odio, soluta, corrupti aliquam
                                quibusdam tempora at cupiditate quis eum maiores libero
                                veritatis? Dicta facilis sint aliquid ipsum atque?
                            </p>
                        </div>

                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <div class="card">
                                <div class="card-body py-5 px-md-5">


                                    <form action='/user/register' method='POST'>

                                        <?= csrf_field(); ?>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="username">Username</label>
                                            <input id="username" name="username" value="<?=set_value('username')?>" class="form-control" placeholder="Username" />
                                            <?php if(isset($validation)): ?>
                                                <span class="text-danger"><small><?= display_error($validation , "username")?display_error($validation , "username") : '';?></small></span>
                                            <?php endif;?>
                                        </div>


                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="email">Email address</label>
                                            <input type="text" id="email" name="email" value="<?=set_value('email') ?>" class="form-control" placeholder="Email" />
                                            <?php if(isset($validation)): ?>
                                                <span class="text-danger"><small><?= display_error($validation , "email")?display_error($validation , "email") : '';?></small></span>
                                            <?php endif;?>
                                        </div>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" name="password" value="<?= set_value('password') ?>" class="form-control" placeholder='Password' />
                                            <?php if(isset($validation)): ?>
                                                <span class="text-danger"><small><?= display_error($validation , "password")?display_error($validation , "password") : '';?></small></span>
                                            <?php endif;?>
                                        </div>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="password-confirm">Password Confirm</label>
                                            <input type="password" id="password-confirm" name="password-confirm" class="form-control" placeholder='Password Confirm' />
                                            <?php if(isset($validation)): ?>
                                                <span class="text-danger"><small><?= display_error($validation , "password-confirm")?display_error($validation , "password-confirm") : '';?></small></span>
                                            <?php endif;?>
                                        </div>


                                        <div style="margin-top:10mm;display:flex; justify-content:center; align-items:center;">
                                            <button type="submit" class="btn btn-primary btn-block mb-4 text-center">
                                                Register
                                            </button>
                                        </div>
                                    </form>
                                    <div class="text-center">
                                        <a href=<?= site_url('user/login')?>>
                                            <small>
                                                Already have an account?
                                            </small>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>