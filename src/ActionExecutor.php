<?php

namespace Massfice\ActionExecutor;

use Massfice\Action\JsonAction;

abstract class ActionExecutor {

    protected $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function execute(JsonAction $action, array $config) {
        $data = $action->load($this->data, $config);
        $status = $action->validate($data);

        \http_response_code($status->getCode());
        $this->setContentType();
        foreach($status->getHeaders() as $header) {
            header($header);
        }

        if($status->isError()) {
            $this->onError($status->getErrors(),$action);
        } else {
            $data = $action->execute($data);
            $this->onDisplay($data,$action);
        }
    }

    abstract protected function onError(array $errors, JsonAction $action);
    abstract protected function onDisplay(array $data, JsonAction $action);
    abstract protected function setContentType();
}

?>