<div class="school-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        该模块主要用于管理学校各项事物
        如：
        学期设置，任教设置
        学生信息表格
        教师信息表格
    </p>
</div>
