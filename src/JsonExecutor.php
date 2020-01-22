<?php

namespace Massfice\ActionExecutor;

use Massfice\Action\JsonAction;

class JsonExecutor extends ActionExecutor {
    protected function onError(array $errors, JsonAction $action) {
        echo \json_encode(["errors" => $errors]);
    }

    protected function onDisplay(array $data, JsonAction $action) {
        echo \json_encode(["data" => $data]);
    }

    protected function setContentType() {
        header("Content-Type: application/json; charset=UTF-8");
    }
}

?>