<?php

    namespace app\components;
    use Yii;

    use yii\base\Component;

    class AdminLoginComponent extends Component{
        private $pass = "Admin999555";
        
        public function checkPass($pass){
            if($this->pass === $pass){
                Yii::$app->session->set('admin', 'true');
                return true;
            } else {
                return false;
            }
        }
    }