<link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/kaiadmin/favicon.png') ?>">
<script src="<?= base_url('assets/js/core/jquery-3.7.1.min.js')?>"></script>
<!-- Bootstrap 5.3 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

|<style>
    body {
        margin: 0;
        padding: 0;
        background: url("<?= base_url('assets/img/login-background.jpg') ?>") no-repeat;
        height: 100vh;
        font-family: sans-serif;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        overflow: hidden
    }

    @media screen and (max-width: 600px; ) {
        body {
            background-size: cover;
            : fixed
        }
    }

    #particles-js {
        height: 100%
    }

    .loginBox {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 350px;
        min-height: 200px;
        background: #ffffff;
        border-radius: 10px;
        padding: 40px;
        box-sizing: border-box
    }

    .user {
        margin: 0 auto;
        display: block;
        margin-bottom: 20px
    }

    h3 {
        margin: 0;
        padding: 0 0 20px;
        color: #59238F;
        text-align: center
    }

    .loginBox input {
        width: 100%;
        margin-bottom: 20px
    }

    .loginBox input[type="text"],
    .loginBox input[type="password"] {
        border: none;
        border-bottom: 2px solid #262626;
        outline: none;
        height: 40px;
        color: #000;
        background: transparent;
        font-size: 16px;
        padding-left: 20px;
        box-sizing: border-box
    }

    /* .loginBox input[type="text"]:hover,
    .loginBox input[type="password"]:hover {
        color: #0000;
        border: 1px solid #42F3FA;
        box-shadow: 0 0 5px rgba(0, 255, 0, .3), 0 0 10px rgba(0, 255, 0, .2), 0 0 15px rgba(0, 255, 0, .1), 0 2px 0 black
    }

    .loginBox input[type="text"]:focus,
    .loginBox input[type="password"]:focus {
        border-bottom: 2px solid #42F3FA
    } */

    .inputBox {
        position: relative
    }

    .inputBox span {
        position: absolute;
        top: 10px;
        color: #262626
    }

    .loginBox input[type="submit"] {
        border: none;
        outline: none;
        height: 40px;
        font-size: 16px;
        background: #59238F;
        color: #fff;
        border-radius: 20px;
        cursor: pointer
    }

    .loginBox a {
        color: #262626;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        text-align: center;
        display: block
    }

    a:hover {
        color: #00ffff
    }

    p {
        color: #0000ff
    }

    @media screen and (max-width: 600px) {
        body {
            background-size: cover;
            background-attachment: fixed;
        }
    }


    .loginBox button[type="submit"] {
        border: none;
        outline: none;
        height: 40px;
        font-size: 16px;
        background: #59238F;
        color: #fff;
        border-radius: 20px;
        cursor: pointer;
        width: 100%;
    }

    /* .loginBox button[type="submit"]:hover {
        background: #dd0eba;
        color: #000;
        box-shadow: 0 0 5px rgba(0, 255, 0, .3),
            0 0 10px rgba(0, 255, 0, .2),
            0 0 15px rgba(0, 255, 0, .1),
            0 2px 0 black;
    } */
    .error-input-feedback{
        color: red !important;
        display: contents;
    }
</style>

<div class="loginBox">
    <img class="user" src="<?= base_url('assets/img/human.png') ?>" height="100px" width="100px">
    <h3>Login here</h3>
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    <form id="form-login" action="<?= base_url('login') ?>" method="post">
        <div class="inputBox">
        <div class="mb-3">
            <label for="uname" class="form-label">Username</label>
            <input id="uname" type="text" name="username" placeholder="Username">
            <span class="text-danger error-input-feedback"></span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="pass" type="password" name="password" placeholder="Password">
            <span class="text-danger error-input-feedback"></span>
        </div>
            
        </div>
        <?= csrf_field() ?>
        <button type="submit">Login</button>
    </form>
</div>
<!-- Bootstrap 5.3 JS (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right", // top-left, top-center, bottom-right, etc.
    "timeOut": "3000"
    };

</script>
<script src="<?= base_url('assets/js/auth.js') ?>"></script>