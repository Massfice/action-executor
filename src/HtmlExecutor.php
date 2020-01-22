<?php

namespace Massfice\ActionExecutor;

use Massfice\Action\JsonAction;

class HtmlExecutor extends ActionExecutor {

    private function validate(JsonAction $action) : bool {
        return isset(class_implements($action)["Massfice\Action\HtmlAction"]);
    }

    protected function onError(array $errors, JsonAction $action) {
        if($this->validate($action)) {
            $action->onError($errors);
        }
    }

    protected function onDisplay(array $data, JsonAction $action) {
        if($this->validate($action)) {
            $action->onDisplay($data);
        }
    }

    protected function setContentType() {
        header("Content-Type: text/html; charset=UTF-8");
    }
}

?>