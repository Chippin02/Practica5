<?php


namespace P;


interface View {

    public function render(Array $dataview, string $template);

}