

<body class=" login">
    <!-- BEGIN LOGO -->
    <div class="logo">
<!--        <a href="index.php">
            <img src="<?php echo base_url(); ?>assets_admin/pages/img/logo-big.png" alt="" /> 
        </a>-->
    </div>
    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <?php $this->load->helper('form'); ?>
        <?php if (validation_errors()) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            </div>
        <?php endif; ?>


        <?php
        $attributes = array('class' => 'login-form');
        echo form_open('admin/login', $attributes);
        ?>

        <h3 class="form-title font-green">مولدات السلطان</h3>

        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">اسم المستخدم</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" required="required" name="username" /> </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">كلمة المرور</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" required="required" name="password" /> </div>
        <div class="form-actions">
            <button name="submit" type="submit" class="btn center-block green uppercase">دخول</button>
<!--            <label class="rememberme check mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember" value="1" />&nbsp;&nbsp;&nbsp;تذكرني
                <span></span>
            </label>-->
        </div>

        <?php echo form_close(); ?>
        <!-- END LOGIN FORM -->


    </div>