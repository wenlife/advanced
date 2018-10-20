<div class="row">
<table class="table" style="border:1px solid #ccc">
<tr class="" style="line-height: 20px;padding-bottom:10px"><td colspan=3><?=$model->content?></td></tr>
<?php
 $options = unserialize($model->options);
rshowAnswer($options,$model->answer,$givenAnswer);
?>
<tr><td colspan=3><strong>Note:</strong><?=$model->note?></td></tr>
<tr><td>来源：<?=$model->source?></td><td><?=$model->date?></td><td><?=$model->date?></td></tr>
</table>
</div>
