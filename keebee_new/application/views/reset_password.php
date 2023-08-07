<?php
$id = $this->uri->segment(3);
$makeId = substr($id, 5, -5);
$userId = base64_decode($makeId);
$curdatetime = date('Y-m-d H:i:s');
$time = base64_decode($this->uri->segment(4));
$endTime = date('Y-m-d H:i:s', strtotime('+60 minutes', strtotime($time)));

if ($this->uri->segment(3) == "" || $this->uri->segment(4) == "") {
    redirect('Forgot/reset_password_expire/');
} else if ($curdatetime > $endTime) {
    redirect('Forgot/reset_password_expire/');
} else {
    ?>

    <!DOCTYPE html>
    <html class="h-100" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Meee</title>
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <style>
            #p_msg {
                display: none;
                clear: both;
                text-align: left;
                width: 100%;
                color: #ff0000;
                font-size: 11px;
                letter-spacing: 0.5px;
                margin-bottom: 0;
                padding: 10px 0 0 0;
            }
        </style>
    </head>

    <body class="h-100">
        <!--*******************                Preloader start            ********************-->
        <div id="preloader">
            <div class="loader">
                <svg class="circular" viewBox="25 25 50 50">
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" /> </svg>
            </div>
        </div>
        <div class="login-form-bg h-100">
            <div class="container h-100">
                <div class="row justify-content-center h-100">
                    <div class="col-xl-5">
                        <div class="form-input-content">
                            <div class="card login-form mb-0" style="background: #ffff;  border: 1px solid #588DAD;">
                                <div class="card-body pt-4" style="text-align: center;"> <img src="<?php echo base_url(); ?>assets/img/logo.png" style="width: 45%; margin-top: 20px; margin-bottom: 20px;" class="img-responsive">
                                    <h4 style=" margin-top: 15px;                                            border-top: 1px solid #021042;                                            padding: 5px;                                            color: #021042;                                            border-bottom: 1px solid #021042;">Reset Password</h4>
                                    <form class="mt-5 mb-3 login-input" action="<?php echo base_url('Forgot/resetprocess'); ?>" method="post" onsubmit="return validateform()">
                                        <?php if ($this->session->flashdata('success')) { ?>
                                            <div class="alert alert-success">
                                                <?php echo $this->session->flashdata('success'); ?>
                                            </div>
                                            <?php } if ($this->session->flashdata('error')) { ?>
                                                <div class="alert alert-danger">
                                                    <?php echo $this->session->flashdata('error'); ?>
                                                </div>
                                                <?php } ?>
                                                    <input type="hidden" name="id" value="<?php echo $userId; ?>">
                                                    <div class="form-group">
                                                        <input type="password" id="password" style="padding-left: 10px;" name="new_password" required="" class="form-control" placeholder="Enter New Password"> </div>
                                                    <div class="form-group">
                                                        <input type="password" id="confirm_password" style="padding-left: 10px;" name="confirm_password" required="" class="form-control" placeholder="Enter Confirm Password">
                                                        <p id="p_msg">Password and confirm password not match.</p>
                                                    </div>
                                                    <button type="submit" class="btn login-form__btn submit w-100" style="background: #021042">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>assets/js/common.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
        <script>
            function validateform() {
                var password = $('#password').val();
                var confirm_password = $('#confirm_password').val();
                if (password == confirm_password) {
                    document.getElementById('p_msg').style.display = "none";
                } else {
                    document.getElementById('p_msg').style.display = "block";
                    return false;
                }
            }
        </script>
    </body>

    </html>
    <?php } ?>