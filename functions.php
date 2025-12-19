<?php

use Tanuki\Utils\FormTagBinder;
use Tanuki\Form;

function h($str) {
  return htmlspecialchars($str);
}

function getErrorMessage(string $type, string $fieldLabel = ""){
  switch($type){
    case "required": return "{$fieldLabel}は必須項目です。";
    case "email": return "{$fieldLabel}の形式が不正です。";
    case "matchField": return "{$fieldLabel}が正しく入力されていません。";
    case "pattern": return "{$fieldLabel}が正しく入力されていません。";
    case "agreement": return "同意してください。";
    default: return "{$type} error";
  }
}

function getConfig($name="config"){
  return include __DIR__ . "/config/{$name}.php";
}

function view($viewName, $data = []){
  extract($data);
  include_once __DIR__ . "/views/{$viewName}.php";
}

function formRoute(Form $form){
  if($_SERVER["REQUEST_METHOD"] === "POST") {
    $form->bind($_POST);
    $binder = new FormTagBinder($form->getRawData());

    switch($_POST["action"] ?? null){
      case "confirm":
        if($form->validate()){
          view("confirm", ["form" => $form, "binder" => $binder]);
        }else{
          view("input", ["form" => $form, "binder" => $binder]);
        }
        break;

      case "send":
        if($form->validate()){
          $result = $form->send();

          if($result->isSuccessful()){
            view("complete", ["form" => $form]);
          }else{
            view("error", ["form" => $form, "result" => $result]);
          }
        }else{
          view("input", ["form" => $form, "binder" => $binder]);
        }
        break;

      case "back":
        view("input", ["form" => $form, "binder" => $binder]);
        break;
    }
  }else {
    view("input", ["form" => $form, "binder" => new FormTagBinder()]);
  }
}
