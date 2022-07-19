<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.7.0/dist/vue.js"></script>
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
        </style>
    </head>
    <body style="text-align: justify" class="bg-white text-dark">
        <?php $this->beginBody() ?>

        <!--Header-->
        <header class="navbar navbar-expand-lg d-flex flex-wrap border-bottom bg-white text-light">
            <div class="container-fluid row row-cols-auto">
                <a href="/" class="col d-flex align-items-center mb-2 mb-md-0 text-decoration-none">Name company</a>
                <button class="col border-0 bg-white text-dark" type="button" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <ion-icon name="reorder-three-outline" style="width: 2.5em; height: 2.5em;"></ion-icon>
                </button>
                <form class="col d-flex" method="get" action="<?= Url::to(["products/search"]); ?>">
                    <input class="form-control me-2" name="searchData" type="search" placeholder="Search" aria-label="Search">
                    <input type="hidden" name='sort' value='popularity'/>
                    <button class="border-0 bg-white text-dark" type="submit">
                        <ion-icon name="search-outline" style="width: 2em; height: 2em;"></ion-icon>
                    </button>
                </form>
                <ul class="col navbar-nav flex-wrap mt-2 mx-3">
                    <li class="nav-item dropdown me-2">
                        <a class="nav-link dropdown-toggle border rounded-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Themes</a>
                        <ul class="dropdown-menu bg-white text-dark border" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#" id="light">Light</a></li>
                            <li><a class="dropdown-item" href="#" id="dark">Dark</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle border rounded-3" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">Language</a>
                        <ul class="dropdown-menu bg-white text-dark border" aria-labelledby="navbarDropdown1">
                            <li><a class="dropdown-item" href="#">Russian</a></li>
                            <li><a class="dropdown-item" href="#">English</a></li>
                        </ul>
                    </li>
                </ul>
                
                <div class="col">
                    <a href="<?= Url::to(['products/cartitem']) ?>"><ion-icon name="cart-outline"></ion-icon></a>
                    <?php if(Yii::$app->user->isGuest){ ?>
                        <a type="button" class="btn btn-outline-primary me-2" href="<?= Url::to(['site/login']) ?>">Login</a>
                        <a type="button" class="btn btn-primary" href="<?= Url::to(['site/register']) ?>">Sign-up</a>
                    <?php } else { ?>
                        <button class="border-0 bg-white text-dark" type="button" data-bs-toggle="collapse" href="#profile" role="button" aria-expanded="false" aria-controls="profile">
                            <ion-icon name="person-outline"></ion-icon>
                        </button>
                    <?php } ?>
                </div>
            </div>
        </header>
        <div class="collapse dropdown-menu row row-cols-1 row-cols-sm-2 row-cols-md-5 bg-white text-dark" id="collapseExample">
            <div class="col">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                    <?php foreach (Yii::$app->cat->getData() as $item){?>
                        <?= '<li class="nav-item"><a href="'. Url::to(["products/catitem", "item" => $item["category"], 'sort'=>'popularity']) .'" class="nav-link">'.$item["category"].'</a></li>'; ?>
                    <?php } ?>
                    <li class="nav-item"><a href="<?= Url::to(['site/view', 'view'=>'about']); ?>" class="nav-link">About</a></li>
                </ul>
            </div>
            <div class="col">
                <ul class="nav flex-column">
                    <?php foreach (Yii::$app->subcat->getData() as $item){?>
                        <?= '<li class="nav-item"><a href="'. Url::to(["products/subcatitem", "item" => $item["subcategory"], 'sort'=>'popularity']) .'" class="nav-link">'.$item["subcategory"].'</a></li>'; ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div id="profile" class="collapse dropdown-menu bg-white text-dark border rounded-3 p-3 text-center float-end position-absolute" style="right: 5px;">
            <div class="figure-img"><ion-icon name="person-outline"></ion-icon></div>
            <big><?= Yii::$app->user->identity->username ?></big><br>
            <?php if(Yii::$app->user->identity->username == "admin"){?>
                <a type="button" href="<?= Url::to(['admin/index']); ?>" class="btn btn-primary">Admin Panel</a><br><br>
            <?php } ?>
            <a type="button" href="<?= Url::to(['site/logout']) ?>" class="btn btn-primary">Log out</a>
        </div>

        <!--Content-->
        <?= $content ?>

        <!--Footer-->
        <footer> 
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-2 mt-5 mx-2 border-top">
                <?php foreach (Yii::$app->cat->getData() as $item){?>
                    <div class="col mb-3">
                        <h5><a href="<?= Url::to(['products/catitem', "item" => $item["category"], 'sort'=>'popularity']); ?>" class="nav-link p-0"><?= $item["category"]; ?></a></h5>
                        <ul class="nav flex-column">
                            <?php foreach (Yii::$app->subcat->getDataSubCat($item["category"]) as $item){?>
                                <li class="nav-item mb-2"><a href="<?= Url::to(['products/subcatitem', "item" => $item["subcategory"], 'sort'=>'popularity']); ?>" class="nav-link p-0"><?= $item["subcategory"]; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <div class="py-1 my-5 mx-2 border-top">
                <a href="/" class="link-dark text-decoration-none">Name company</a><br><br>
                <div id="networks" class="row row-cols-sm-auto mx-2">
                    <a href="https://www.facebook.com/profile.php?id=100012837421755" target="_blank"><ion-icon name="logo-facebook"></ion-icon></a>
                    <a href="https://vk.com/dmitriyr03" target="_blank"><ion-icon name="logo-vk"></ion-icon></a>
                    <a href="https://github.com/rusnakdima" target="_blank"><ion-icon name="logo-github"></ion-icon></a>
                    <a href="https://twitter.com/Dmitriy303" target="_blank"><ion-icon name="logo-twitter"></ion-icon></a>
                    <a href="https://www.youtube.com/channel/UCulRfcSqKl30sYNBuQ6CsHA" target="_blank"><ion-icon name="logo-youtube"></ion-icon></a>
                </div>
                <br>
                <p class="text-muted">© 2022 <a href="<?= Url::to(['site/view', 'view'=>'terms']) ?>" class="link-dark">Terms of Service</a> <a href="<?= Url::to(['site/view', 'view'=>'privacy']) ?>" class="link-dark">Privacy Policy</a> <a href="<?= Url::to(['site/view', 'view'=>'about']) ?>" class="link-dark">About Us</a></p>
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
            });
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
                $("input[type=checkbox]").removeClass("bg-white");
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
                $("input[type=checkbox]").removeClass("bg-dark");
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