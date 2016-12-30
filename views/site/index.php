<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'My Tasks!';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= $this->title ?></h1>
        <p class="lead">Um sistema para gerenciamento de suas tarefas!</p>
        <p><a href="#" class="btn btn-primary h2" data-toggle="modal" data-target="#nova-tarefa-modal">Criar uma nova Task!</a></p>
    </div>

    <div class="body-content">
        
        <div id="list" class="row">

            <div class="table-responsive col-md-12" id="table-data">
                <table class="table table-striped" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>Data de Criação</th>
                            <th>Título</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th>Ações</th>
                         </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($tasks as $task) { ?>
                        <tr>
                            <td><?= $task[0] ?></td>
                            <td><?= $task[1] ?></td>
                            <td><?= $task[2] ?></td>
                            <td><span class="label label-<?php if($task[3] == 'Em aberto') echo 'primary'; else if($task[3] == 'Em execução') echo 'success'; else if($task[3] == 'Finalizada') echo 'danger'; ?>"><?= $task[3] ?></span></td>
                            <td class="actions">
                                <a class="btn btn-success btn-xs visualizar" file="<?= $task[0] ?>" href="#" data-toggle="modal" data-target="#visualizar-modal"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a class="btn btn-warning btn-xs editar" file="<?= $task[0] ?>" href="#" data-toggle="modal" data-target="#editar-modal"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a class="btn btn-danger btn-xs excluir" file="<?= $task[0] ?>" href="#" data-toggle="modal" data-target="#excluir-modal"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>

        </div> <!-- /#list -->

        <!-- INICIO MODAL NOVA TAREFA -->
        <?php
            $formCreate = ActiveForm::begin([
                        'method' => 'post',
                        'action' => ['site/create'],
                        ]);
            Modal::begin([
                'header' => '<h3><span class="glyphicon glyphicon-edit"></span> Nova Tarefa</h3>',
                'id' => 'nova-tarefa-modal',
                'footer' => Html::button('Cancelar', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) . Html::submitButton('Criar', ['class' => 'btn btn-primary'])
            ]);
        ?>
            <div class="row">
                <div class="form-group col-md-12">
                  <label for="nome">Título:</label>
                  <input type="text" class="form-control" name="titulo" placeholder="Título" maxlength="50">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                  <label for="email">Descrição:</label>
                  <textarea class="form-control" rows="5" name="descricao" placeholder="Descreva aqui detalhes de sua tarefa"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                      <label for="status">Status:</label>
                      <select class="form-control" name="status">
                        <option>Em aberto</option>
                        <option>Em execução</option>
                        <option>Finalizada</option>
                      </select>
                </div>
            </div>
        <?php
            Modal::end();
            ActiveForm::end();
        ?>
        <!-- FIM MODAL NOVA TAREFA -->

        <!-- INICIO MODAL VISUALIZAR-->
        <?php
            Modal::begin([
                'header' => '<h3><span class="glyphicon glyphicon-eye-open"></span> Visualizar Tarefa</h3>',
                'id' => 'visualizar-modal',
                'footer' => Html::button('Ok', ['class' => 'btn btn-success', 'data-dismiss' => 'modal'])
            ]);
        ?>
            <div class="row">
                <div class="form-group col-md-12">
                  <input type="hidden" class="visualizar-id" name="id" value="">
                  <label for="nome">Título:</label>
                  <input type="text" class="form-control visualizar-titulo" name="titulo" placeholder="Título">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                  <label for="email">Descrição:</label>
                  <textarea class="form-control visualizar-descricao" rows="5" name="descricao" placeholder="Descreva aqui detalhes de sua tarefa"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                      <label for="status">Status:</label>
                      <select class="form-control visualizar-status" name="status">
                        <option>Em aberto</option>
                        <option>Em execução</option>
                        <option>Finalizada</option>
                      </select>
                </div>
            </div>
        <?php
            Modal::end();
        ?>
        <!--FIM MODAL VISUALIZAR-->

        <!--INICIO MODAL EDITAR-->
        <?php
            $formUpdate = ActiveForm::begin([
                        'method' => 'post',
                        'action' => ['site/update'],
                        ]);
            Modal::begin([
                'header' => '<h3><span class="glyphicon glyphicon-pencil"></span> Editar Tarefa</h3>',
                'id' => 'editar-modal',
                'footer' => Html::button('Cancelar', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) . Html::submitButton('Alterar', ['class' => 'btn btn-warning'])
            ]);
        ?>
            <div class="row">
                <div class="form-group col-md-12">
                  <input type="hidden" class="editar-id" name="id" value="">
                  <label for="nome">Título:</label>
                  <input type="text" class="form-control editar-titulo" name="titulo" placeholder="Título" maxlength="50">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                  <label for="email">Descrição:</label>
                  <textarea class="form-control editar-descricao" rows="5" name="descricao" placeholder="Descreva aqui detalhes de sua tarefa"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                      <label for="status">Status:</label>
                      <select class="form-control editar-status" name="status">
                        <option>Em aberto</option>
                        <option>Em execução</option>
                        <option>Finalizada</option>
                      </select>
                </div>
            </div>
        <?php
            Modal::end();
            ActiveForm::end();
        ?>
        <!--FIM MODAL EDITAR-->

        <!--INICIO MODAL EXCLUIR-->
        <?php
            $formDelete = ActiveForm::begin([
                        'method' => 'post',
                        'action' => ['site/delete'],
                        ]);
            Modal::begin([
                'header' => '<h3><span class="glyphicon glyphicon-trash"></span> Excluir Tarefa?</h3>',
                'id' => 'excluir-modal',
                'footer' => Html::button('Cancelar', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) . Html::submitButton('Sim', ['class' => 'btn btn-danger'])
            ]);
        ?>
            <div class="row">
                <div class="form-group col-md-12">
                  <input type="hidden" class="excluir-id" name="id" value="">
                  <label for="nome">Título:</label>
                  <input type="text" class="form-control excluir-titulo" name="titulo" placeholder="Título">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                  <label for="email">Descrição:</label>
                  <textarea class="form-control excluir-descricao" rows="5" name="descricao" placeholder="Descreva aqui detalhes de sua tarefa"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                      <label for="status">Status:</label>
                      <select class="form-control excluir-status" name="status">
                        <option>Em aberto</option>
                        <option>Em execução</option>
                        <option>Finalizada</option>
                      </select>
                </div>
            </div>
        <?php
            Modal::end();
            ActiveForm::end();
        ?>
        <!--FIM MODAL EXCLUIR-->

    </div>
</div>

<script>

function populaFormAjax(id, classname) {
    $.ajax({
        url: '<?= Yii::$app->request->baseUrl . '/?r=site/view' ?>',
        type: 'post',
        data: {
            id: id
        },
        success: function (data) {
            var dados = $.parseJSON(data);
            console.log(dados);
            $(classname+'id').val(dados[0]);
            $(classname+'titulo').val(dados[1]);
            $(classname+'descricao').val(dados[2]);
            $(classname+'status').val(dados[3]);
            if(classname != '.editar-') {
                $(classname+'titulo').attr("disabled", true);
                $(classname+'descricao').attr("disabled", true);
                $(classname+'status').attr("disabled", true);
            }
        },
        error: function () {
            console.log("ERROR");
        }
    });
}

$('.visualizar').click(function () {
    var id = $(this).attr('file');
    var classname = '.visualizar-';
    populaFormAjax(id, classname);
});

$('.editar').click(function () {
    var id = $(this).attr('file');
    var classname = '.editar-';
    populaFormAjax(id, classname);
});

$('.excluir').click(function () {
    var id = $(this).attr('file');
    var classname = '.excluir-';
    populaFormAjax(id, classname);
});

</script>
