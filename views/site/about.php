<?php
    $this->title = Yii::t('app', 'About us');
?>



<section class="justify-content-center container">
    <h1 class="fw-light">About</h1>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</section>


<div class="container px-5 py-5 bg-white border rounded-5">
    <form class="justify-content-between container">
        <h3><?= Yii::t('app', 'Contact Us') ?></h3>
        <div class="col ms-3 my-3 border-bottom">
            <span class="row fs-6 mx-2"><?= Yii::t('app', 'Your Name') ?></span>
            <input class="row fs-5 mx-2" type="text" name="name" >
        </div>
        <div class="col ms-3 my-3 border-bottom">
            <span class="row fs-6 mx-2"><?= Yii::t('app', 'Email') ?></span>
            <input class="row fs-5 mx-2" type="text" name="email" >
        </div>
        <div class="col ms-3 my-3 border-bottom">
            <span class="row fs-6 mx-2"><?= Yii::t('app', 'Message') ?></span>
            <textarea class="row fs-5 mx-2" name="message" placeholder="<?= Yii::t('app', 'Enter your message here') ?>"></textarea>
        </div>
        <div class="container-contact100-form-btn">
            <button class="btn btn-primary">
                <span><?= Yii::t('app', 'Submit') ?></span>
            </button>
        </div>
    </form>
    <span class="fs-6 text-muted"><?= Yii::t('app', 'For any question contact our 24/7 call center') ?>: <span style="color: red;">+012 345 6789</span></span>
</div>