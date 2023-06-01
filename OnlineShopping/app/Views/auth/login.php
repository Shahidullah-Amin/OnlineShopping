<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Sign Ip</title>
</head>

<body>


    <div class="container">
        <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-success" style="padding-left:2rem;padding-right:2rem; margin-left:2rem;margin-right:2rem; margin-bottom:0%;">
                <?= session()->getFlashdata('success'); ?>, now you are able to login
            </div>
        <?php endif; ?>
        <?php if (!empty(session()->getFlashdata('failed'))) : ?>
            <div class="alert alert-warning" style="padding-left:2rem;padding-right:2rem; margin-left:2rem;margin-right:2rem; margin-bottom:0%;">
                <?= session()->getFlashdata('failed'); ?>
            </div>
        <?php endif; ?>
        <section style='padding:2rem; padding-top:0%; margin-top:0%;'>
            <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%); border-radius:1mm;">
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

                                    <div class="container text-center">
                                        <h3>
                                            Log in
                                        </h3>
                                    </div>

                                    <form method="POST" action='<?= site_url('user/login') ?>'>

                                        <?= csrf_field(); ?>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="username">User email</label>
                                            <input id="text" name="email" class="form-control" placeholder="Email" value="<?=set_value('email') ?>" />
                                            <?php if(isset($validation)): ?>
                                                <span class="text-danger"><small><?=display_error($validation , 'email')?display_error($validation , 'email'):''; ?></small></span>
                                            <?php endif;?>
                                        </div>


                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <?php if(!empty(session()->getFlashdata('fail'))): ?>
                                                <input type="password" id="password" name="password" class="form-control" placeholder='Password' style="border:1px solid rgb(220, 0, 0);" />
                                                <span class="text-danger" style="padding-left: 1mm;"><?=session()->getFlashdata('fail')?></span>
                                            <?php else: ?>
                                                    <input type="password" id="password" name="password" class="form-control" placeholder='Password' />
                                            <?php endif;?>
                                            <?php if(isset($validation)): ?>
                                                <span class="text-danger"><small><?=display_error($validation , 'password')?display_error($validation , 'password'):''; ?></small></span>
                                            <?php endif;?>
                                        </div>


                                        <div style="display: flex; align-items:center; justify-content:center; ">

                                            <button type="submit" class="btn btn-primary btn-block mb-4 text-center">
                                                Login
                                            </button>
                                        </div>

                                        <div class="text-center">
                                            <small>
                                                <a href="<?= site_url('user/register') ?>">
                                                    Need an account?
                                                </a>
                                            </small>
                                        </div>
                                    </form>

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