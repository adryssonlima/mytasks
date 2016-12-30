<?php

namespace app\models;

use SplFileObject;


class Task {

    private $id;
    private $titulo;
    private $descricao;
    private $status;

    public function newTask() {

        $conteudo  = $this->id . PHP_EOL;
        $conteudo .= $this->titulo . PHP_EOL;
        $conteudo .= $this->descricao . PHP_EOL;
        $conteudo .= $this->status;

        $file = new SplFileObject("tasks/$this->id.txt", "w");
        $escreve = $file->fwrite($conteudo);
        $file = NULL; //Fecha o arquivo

        if($escreve == NULL) {
            unlink("tasks/$this->id.txt"); //apaga o arquivo criado
            return false;
        }
        return true;
    }

    public function editTask(){

        if (file_exists("tasks/$this->id.txt")) {
            return $this->newTask();
        }

    }

    public function deleteTask(){

        if (file_exists("tasks/$this->id.txt")) {
            if (unlink("tasks/$this->id.txt"))
                return true;
            return false;
        }
        return true;
    }

    public function viewTask() {

        if (file_exists("tasks/$this->id.txt")) {
            $task = file("tasks/$this->id.txt");
            $task[0] = substr($task[0], 0, -1); //Remove a quebra de linha
            $task[1] = substr($task[1], 0, -1); //Remove a quebra de linha
            $task[2] = substr($task[2], 0, -1); //Remove a quebra de linha
            return json_encode($task);
        }
        return false;
    }

    public function getAllTasks(){
        $tasks = [];
        $files = scandir("tasks/", 1);
        $remove = array_pop($files); //remove os 2 ultimos elementos do array
        $remove = array_pop($files);
        foreach ($files as $key) {
            $lines = file("tasks/$key");
            $lines[0] = substr($lines[0], 0, -1); //Remove a quebra de linha
            $lines[1] = substr($lines[1], 0, -1); //Remove a quebra de linha
            $lines[2] = substr($lines[2], 0, -1); //Remove a quebra de linha
            if(strlen($lines[2]) > 50) { //Faz o tratamento para não mostrar toda a string na view da indez
                $lines[2] = substr($lines[2], 0, 50);
                $lines[2] .= '...';
            }
            $tasks[] = $lines;
        }
        return $tasks;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setStatus($status) {
        $this->status = $status;
    }


}

?>
