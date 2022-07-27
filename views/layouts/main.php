<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
        <title><?= Html::encode($this->title) ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            ion-icon{
                width: 8em;
                height: 3em;
            }
            #networks > a > ion-icon{
                width: 1.5em;
                height: 1.5em;
            }
            input, textarea{
                border: none;
            }
            .nav-tabs .nav-link.active{
                background-color: rgba(0,0,0,0);
                border-bottom: 1px solid rgba(0,0,0,0);
            }
            #bottomNav ion-icon{
                width: 3em;
                height: 3em;
            }
        </style>
    </head>
    <body style="text-align: justify" class="bg-white text-dark">
        <?php $this->beginBody() ?>

        <!--Header-->
        <header class="navbar navbar-expand-lg d-flex flex-wrap border-bottom bg-white text-light">
            <div class="container-fluid row row-cols-md-12">
                <div class="col-auto" id="logo">
                    <a href="/" class="mb-2 mb-md-0 text-decoration-none">Name company</a>
                    <button class="border-0 right-0 float-end bg-white text-dark" type="button" data-bs-toggle="collapse" href="#navmenu" aria-expanded="false" aria-controls="navmenu">
                        <ion-icon name="menu-outline" style="width: 2.5em; height: 2.5em;"></ion-icon>
                    </button>
                </div>
                <form id="elemHide1" class="col" method="get" action="<?= Url::to(["products/search"]); ?>">
                    <input class="form-control form-control-lg" style="width: 95%; display: initial;" name="searchData" type="search" placeholder="<?= Yii::t('app', 'Search') ?>" aria-label="Search">
                    <input type="hidden" name='sort' value='popularity'>
                    <button class="border-0 bg-white text-dark" type="submit">
                        <ion-icon name="search-outline" style="width: 2em; height: 2em;"></ion-icon>
                    </button>
                </form>
                <div id="elemHide2" class="col-auto float-end">
                    <a href="<?= Url::to(['products/cartitem']) ?>"><ion-icon name="cart-outline"></ion-icon></a>
                    <?php if(Yii::$app->user->isGuest){ ?>
                        <a type="button" class="btn btn-outline-primary me-2" href="<?= Url::to(['site/login']) ?>"><?= Yii::t('app', 'Login') ?></a>
                        <a type="button" class="btn btn-primary" href="<?= Url::to(['site/register']) ?>"><?= Yii::t('app', 'Sign up') ?></a>
                    <?php } else { ?>
                        <button class="border-0 bg-white text-dark" type="button" data-bs-toggle="collapse" href="#profile" aria-expanded="false" aria-controls="profile">
                            <ion-icon name="person-outline"></ion-icon>
                        </button>
                    <?php } ?>
                </div>
            </div>
        </header>
        <!--Navigation Menu-->
        <div class="border collapse position-absolute row row-cols-2 bg-white text-dark" style="z-index: 500; left: 15px;" id="navmenu">
            <ul class="nav d-block">
                <li class="nav-item"><a href="/" class="nav-link"><?= Yii::t('app', 'Home') ?></a></li>
                <?php foreach (Yii::$app->cat->getData() as $item){?>
                    <?= '<li class="nav-item"><a href="'. Url::to(["products/catitem", "item" => $item["category"], 'sort'=>'popularity']) .'" class="nav-link">'.Yii::t('app', $item["category"]).'</a></li>'; ?>
                <?php } ?>
                <li class="nav-item"><a href="<?= Url::to(['site/view', 'view'=>'about']); ?>" class="nav-link"><?= Yii::t('app', 'About us') ?></a></li>
            </ul>
            <ul class="nav d-block">
                <?php foreach (Yii::$app->subcat->getData() as $item){?>
                    <?= '<li class="nav-item"><a href="'. Url::to(["products/subcatitem", "item" => $item["subcategory"], 'sort'=>'popularity']) .'" class="nav-link">'.Yii::t('app', $item["subcategory"]).'</a></li>'; ?>
                <?php } ?>
            </ul>
        </div>
        <!--Profile Modal Window-->
        <div id="profile" class="collapse dropdown-menu bg-white text-dark border rounded-3 p-3 text-center float-end position-absolute" style="right: 5px;">
            <div class="figure-img"><ion-icon name="person-outline"></ion-icon></div>
            <big><?= Yii::$app->user->identity->username ?></big><br>
            <?php if(Yii::$app->user->identity->username == "admin"){?>
                <a type="button" href="<?= Url::to(['admin/index']); ?>" class="btn btn-primary"><?= Yii::t('app', 'Admin Panel') ?></a><br><br>
            <?php } ?>
            <a type="button" href="<?= Url::to(['site/logout']) ?>" class="btn btn-primary"><?= Yii::t('app', 'Log out') ?></a>
        </div>

        <!--Content-->
        <?= $content ?>

        <!--Bottom Navigation-->
        <nav class="mx-2 navbar container position-fixed bottom-0 row row-cols-sm-4 row-cols-md-4 row-cols-lg-4 bg-white text-dark" id="bottomNav" style="z-index: 500;">
            <a class="col-auto text-center" href="/"><ion-icon name="home-outline"></ion-icon></a>
            <button class="col-auto border-0 bg-white text-dark" type="button" data-bs-toggle="collapse" href="#searchMenu" aria-expanded="false" aria-controls="searchMenu">
                <ion-icon name="search-outline"></ion-icon>
            </button>
            <a class="col-auto text-center" href="<?= Url::to(['products/cartitem']) ?>"><ion-icon name="cart-outline"></ion-icon></a>
            <button class="col-auto border-0 bg-white text-dark" type="button" data-bs-toggle="collapse" href="#profileMenu" aria-expanded="false" aria-controls="profileMenu">
                <ion-icon name="person-outline"></ion-icon>
            </button>
        </nav>
        <!--Search Modal Window-->
        <div id="searchMenu" class="collapse dropdown-menu bg-white text-dark border rounded-3 p-3 text-center float-end position-absolute" style="left: 5rem; bottom: 70px;">
            <form class="col" method="get" action="<?= Url::to(["products/search"]); ?>">
                <input class="form-control me-2" name="searchData" type="search" placeholder="<?= Yii::t('app', 'Search') ?>" aria-label="Search">
                <input type="hidden" name='sort' value='popularity'/>
                <button class="border-0 bg-white text-dark" type="submit">
                    <ion-icon name="search-outline" style="width: 2em; height: 2em;"></ion-icon>
                </button>
            </form>
        </div>
        <!--Profile Modal Window-->
        <div id="profileMenu" class="collapse dropdown-menu bg-white text-dark border rounded-3 p-3 text-center float-end position-absolute" style="right: 5px; bottom: 70px;">
            <?php if(Yii::$app->user->isGuest){ ?>
                <a type="button" class="btn btn-outline-primary me-2" href="<?= Url::to(['site/login']) ?>"><?= Yii::t('app', 'Login') ?></a>
                <br><br>
                <a type="button" class="btn btn-primary" href="<?= Url::to(['site/register']) ?>"><?= Yii::t('app', 'Sign up') ?></a>
            <?php } else { ?>
                <div class="figure-img"><ion-icon name="person-outline"></ion-icon></div>
                <big><?= Yii::$app->user->identity->username ?></big><br>
                <?php if(Yii::$app->user->identity->username == "admin"){?>
                    <a type="button" href="<?= Url::to(['admin/index']); ?>" class="btn btn-primary"><?= Yii::t('app', 'Admin Panel') ?></a><br><br>
                <?php } ?>
                <a type="button" href="<?= Url::to(['site/logout']) ?>" class="btn btn-primary"><?= Yii::t('app', 'Log out') ?></a>
            <?php } ?>
        </div>

        <!--Footer-->
        <footer> 
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-2 mt-5 mx-2 border-top">
                <?php foreach (Yii::$app->cat->getData() as $item){?>
                    <div class="col mb-3">
                        <h5><a href="<?= Url::to(['products/catitem', "item" => $item["category"], 'sort'=>'popularity']); ?>" class="nav-link p-0"><?= Yii::t('app', $item["category"]); ?></a></h5>
                        <ul class="nav flex-column">
                            <?php foreach (Yii::$app->subcat->getDataSubCat($item["category"]) as $item){?>
                                <li class="nav-item mb-2"><a href="<?= Url::to(['products/subcatitem', "item" => $item["subcategory"], 'sort'=>'popularity']); ?>" class="nav-link p-0"><?= Yii::t('app', $item["subcategory"]); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <div class="py-1 my-5 mx-2 border-top">
                <div class="d-flex flex-wrap bg-white text-dark">
                    <a href="/" class="link-dark text-decoration-none">Name company</a>
                    <span>   </span>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown me-2">
                            <a class="nav-link dropdown-toggle border rounded-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= Yii::t('app', 'Themes'); ?></a>
                            <ul class="dropdown-menu bg-white text-dark border" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#" id="light"><?= Yii::t('app', 'Light'); ?></a></li>
                                <li><a class="dropdown-item" href="#" id="dark"><?= Yii::t('app', 'Dark'); ?></a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle border rounded-3" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= Yii::t('app', 'Language'); ?></a>
                            <ul class="dropdown-menu bg-white text-dark border" aria-labelledby="navbarDropdown1">
                                <li><?php echo Html::a(Yii::t('app', 'Russian'), array_merge(Yii::$app->request->get(), [Yii::$app->controller->route, 'language' => 'ru']), ['class' => 'dropdown-item']); ?></li>
                                <li><?php echo Html::a(Yii::t('app', 'English'), array_merge(Yii::$app->request->get(), [Yii::$app->controller->route, 'language' => 'en']), ['class' => 'dropdown-item']); ?></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <br>
                <div id="networks" class="row row-cols-1 row-cols-sm-6 mx-2">
                    <span><?= Yii::t('app', 'Social networks'); ?></span>
                    <a href="https://www.facebook.com/profile.php?id=100012837421755" target="_blank"><ion-icon name="logo-facebook"></ion-icon></a>
                    <a href="https://vk.com/dmitriyr03" target="_blank"><ion-icon name="logo-vk"></ion-icon></a>
                    <a href="https://github.com/rusnakdima" target="_blank"><ion-icon name="logo-github"></ion-icon></a>
                    <a href="https://twitter.com/Dmitriy303" target="_blank"><ion-icon name="logo-twitter"></ion-icon></a>
                    <a href="https://www.youtube.com/channel/UCulRfcSqKl30sYNBuQ6CsHA" target="_blank"><ion-icon name="logo-youtube"></ion-icon></a>
                </div>
                <br>
                <p class="text-muted">© 2022 <a href="<?= Url::to(['site/view', 'view'=>'terms']) ?>" class="link-dark"><?= Yii::t('app', 'Terms of Service') ?></a> <a href="<?= Url::to(['site/view', 'view'=>'privacy']) ?>" class="link-dark"><?= Yii::t('app', 'Privacy Policy') ?></a> <a href="<?= Url::to(['site/view', 'view'=>'about']) ?>" class="link-dark"><?= Yii::t('app', 'About us') ?></a></p>
            </div>
        </footer>
        
        <!--Scripts-->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script>
            $(document).ready(function() {
                if(localStorage['theme'] == undefined) localStorage['theme'] = "light";
                if(localStorage['theme'] == "light") LightTheme();
                if(localStorage['theme'] == "dark") DarkTheme();
                $("#elemHide1").show();
                $("#elemHide2").show();
                $("#bottomNav").hide();
            });
            setInterval(()=>{
                if($("body").width() <= 800){
                    $("#elemHide1").hide();
                    $("#elemHide2").hide();
                    $("#bottomNav").show();
                    $("#logo").removeClass("col-auto");
                } else {
                    $("#elemHide1").show();
                    $("#elemHide2").show();
                    $("#bottomNav").hide();
                    $("#logo").attr("class", "col-auto");
                    $("#searchMenu").removeClass("show");
                    $("#profileMenu").removeClass("show");
                }
            }, 250);
            function LightTheme(){
                localStorage["theme"] = "light";
                var title = "<?php echo $this->title ?>";
                var list = document.querySelectorAll('header .nav-link');
                $(".bg-dark, input, textarea, select").addClass("bg-white").removeClass("bg-dark");
                $(".text-light, .navbar a, input, textarea, select").addClass("text-dark").removeClass("text-light");
                $(".nav-link").css({"color": "#000"});
                $("footer .nav-link").css({"color": "rgba(31,37,41,0.75)"});
                $(".nav-tabs .nav-link").css({"color": "#000", "background-color":"rgba(0,0,0,0)"});
                $(".nav-tabs .nav-link.active").css({"color": "#000", "background-color":"rgba(0,0,0,0)"});
                $("header .nav-link, .dropdown-item").removeClass("text-dark").css({"color":"#000", "background":"#fff"});
                $("header .nav-link, .dropdown-item").mouseover(function(){
                    $(this).css({"background-color": "#ccc", "color": "#000"});
                });
                $("header .nav-link, .dropdown-item").mouseout(function(){
                    $(this).css({"background-color": "#fff", "color": "#000"});
                    for(var i = 0; i < list.length; i++){
                        if($(list[i]).text() == title){
                            $(list[i]).css({"color":"#000"});
                        }
                    }
                });

                for(var i = 0; i < list.length; i++){
                    if($(list[i]).text() == title){
                        $(list[i]).css({"color":"#000"});
                    }
                }
                $("#networks a").css({"color": "#000", "background-color": "#fff"});
                $("#networks a").mouseover(function(){
                    $(this).css({"background-color": "#000", "color": "#fff"});
                });
                $("#networks a").mouseout(function(){
                    $(this).css({"background-color": "#fff", "color": "#000"});
                });
                $(".text-white-50").addClass("text-muted").removeClass("text-white-50");
                $(".link-light").addClass("link-dark").removeClass("link-light");
                $(".help-block").css({"color":"red"});
                $("input[type=checkbox], input[type=radio]").removeClass("bg-white").css({"border":"1px solid black"});
                $("img").css({"background":'white'});
            }
            function DarkTheme(){
                localStorage["theme"] = "dark";
                var title = "<?php echo $this->title ?>";
                var list = document.querySelectorAll('.navbar .nav-link');
                $(".bg-white, input, textarea, select").addClass("bg-dark").removeClass("bg-white");
                $(".text-dark, .navbar a, input, textarea, select").addClass("text-light").removeClass("text-dark");
                $(".nav-link").css({"color": "#fff"});
                $("footer .nav-link").css({"color": "rgba(248,249,250,0.75)"});
                $(".nav-tabs .nav-link").css({"color": "#fff", "background-color":"rgba(0,0,0,0)"});
                $(".nav-tabs .nav-link.active").css({"color": "#fff"});
                $(".navbar .nav-link, .dropdown-item").removeClass("text-light").css({"color":"#fff", "background":"#212529"});
                $(".navbar .nav-link, .dropdown-item").mouseover(function(){
                    $(this).css({"background-color": "#666", "color": "#fff"});
                });
                $(".navbar .nav-link, .dropdown-item").mouseout(function(){
                    $(this).css({"background-color": "#212529", "color": "#fff"});
                    for(var i = 0; i < list.length; i++){
                        if($(list[i]).text() == title){
                            $(list[i]).css({"color":"#fff"});
                        }
                    }
                });

                for(var i = 0; i < list.length; i++){
                    if($(list[i]).text() == title){
                        $(list[i]).css({"color":"#fff"});
                    }
                }
                $("#networks a").css({"color": "#fff", "background-color": "#212529"});
                $("#networks a").mouseover(function(){
                    $(this).css({"background-color": "#fff", "color": "#212529"});
                });
                $("#networks a").mouseout(function(){
                    $(this).css({"background-color": "#212529", "color": "#fff"});
                });
                $(".text-muted").addClass("text-white-50").removeClass("text-muted");
                $(".link-dark").addClass("link-light").removeClass("link-dark");
                $(".help-block").css({"color":"red"});
                $("input[type=checkbox], input[type=radio]").removeClass("bg-dark");
                $("img").css({"background":'white'});
            }
            $("#light").click(function(){
                LightTheme();
            });
            $("#dark").click(function(){
                DarkTheme();
            });
        </script>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>