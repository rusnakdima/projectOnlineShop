<?php

    namespace app\components;
    use Yii;
    use yii\helpers\Url;
    use \Dejurin\GoogleTranslateForFree;
    use yii\i18n\MissingTranslationEvent;

    class TranslationEventHandler {
        public static function handleMissingTranslation(MissingTranslationEvent $event) {
            $event->translatedMessage = "#miss: {$event->category}[{$event->message}]; lang: {$event->language}#";
            $sql = "INSERT INTO `source_message` (`category`, `message`) VALUES ('{$event->category}', '{$event->message}');";
            Yii::$app->db->createCommand($sql)->execute();
            $count = count((new \yii\db\Query())->from('source_message')->all());
            $source = 'en';
            $attempts = 5;
            $tr = new GoogleTranslateForFree;
            $rezult = $tr->translate($source, $event->language, $event->message, $attempts);
            $sql = "INSERT INTO `message` (`id`, `language`, `translation`) VALUES ('{$count}', '{$event->language}', '{$rezult}');";
            Yii::$app->db->createCommand($sql)->execute();
        }
    }