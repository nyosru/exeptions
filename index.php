<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

date_default_timezone_set("Asia/Yekaterinburg");

/**
 * обозначаем класс который будет работать когда случается это исключение 
 * ( вызываем называние класса throw new \NoFoundDataFile(' message ', int code ); )
 */
class NoFoundDataFile extends \Exception {

// Переопределим исключение так, что параметр message станет обязательным
    public function __construct($message, $code = 0, Exception $previous = null) {

        // некоторый код выполняем
        //$this->sendMsg($message);
        //здесь можем что то делать если пошла обработка этого исключения
        echo __FILE__ . ' [' . __LINE__ . '] началась обработка исключения ';

        parent::__construct($message, $code, $previous);
    }

    /**
     * сообщение при возникновении такого исключения
     * Переопределим строковое представление объекта.
     * @return type 
     */
    public function __toString() {
        return ' ' . __CLASS__ . ' [code#' . $this->code . '] ' . $this->message;
    }

//    public function sendMsg($msg) {
//        echo '<br/>'.__FILE__.' ['.__LINE__.']';
//        echo '<br/>Мы можем определять новые методы в наследуемом классе';
//        echo '<br/>';
//    }
}

try {

    // какая то ситуация когда вылетает исключение
    throw new \NoFoundDataFile(' текст сообщение ', 1);
} catch (NoFoundDataFile $e) {

    // и мы ловим наше исключение .. внутри класса делаем что нужно ... 
    // у каждого названия своё функционал который можно регулировать номерами ошибок Code передаваемыми в вызове исключения

    echo '<fieldset><legend>сработало исключение фирменное NoFoundDataFile</legend>'
    . 'message: ' . $e->getMessage()
    . '<br/>code: #' . $e->getCode()
    . '<br/>где ' . $e->getFile() . ' [' . $e->getLine() . ']'
    . '</fieldset>';
} catch (Exception $e) {

    // и обработка другого исключения если было не наше первое а это универсальное

    echo '<fieldset><legend>сработало исключение Exception</legend>'
    . 'message: ' . $e->getMessage()
    . '<br/>code: #' . $e->getCode()
    . '<br/>где ' . $e->getFile() . ' [' . $e->getLine() . ']'
    . '</fieldset>';
}

