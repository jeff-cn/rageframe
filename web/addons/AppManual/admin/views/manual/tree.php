<?php
use common\helpers\AddonsUrl;

?>
<?php foreach($models as $k => $model){ ?>
    <tr id = <?= $model['id']?>>
        <td><?= $model['id']?></td>
        <td>
            <?php for($i = 1;$i < $model['level'];$i++){ ?>　　
                <?php if($i == $model['level']-1) {
                    if(isset($models[$k+1])){
                        echo "├──";
                    }else{
                        echo "└──";
                    }
                }?>
            <?php } ?>
            <?php if($model['pid']==0){ ?>
                <b><?= $model['title']?></b>&nbsp;
            <?php }else{ ?>
                <?= $model['title']?>&nbsp;
            <?php } ?>
            <!--禁止显示二级分类再次添加三级分类-->
            <?php if($model['pid']==0){ ?>
                <a href="<?= AddonsUrl::to(['edit','pid'=>$model['id'],'parent_title'=>$model['title'],'level'=>$model['level']+1])?>">
                    <i class="fa fa-plus-circle"></i>
                </a>
            <?php } ?>
        </td>
        <td><?= $model['name']?></td>
        <td><?= $model['view']?></td>
        <td class="col-md-1"><input type="text" class="form-control" value="<?= $model['sort']?>" onblur="sort(this)"></td>
        <td>
            <?php if($model['pid'] > 0){ ?>
                <a href="<?= AddonsUrl::to(['view','id'=>$model['id']])?>" data-toggle='modal' data-target='#ajaxModalLg'><span class="btn btn-white btn-sm">预览</span></a>&nbsp
            <?php } ?>
            <a href="<?= AddonsUrl::to(['edit','id'=>$model['id'],'parent_title'=>$parent_title])?>"><span class="btn btn-info btn-sm">编辑</span></a>&nbsp
            <?php echo $model['status'] == -1 ? '<span class="btn btn-primary btn-sm" onclick="status(this)">启用</span>': '<span class="btn btn-default btn-sm"  onclick="status(this)">禁用</span>' ;?>
            <a href="<?= AddonsUrl::to(['delete','id'=>$model['id']])?>"  onclick="deleted(this);return false;"><span class="btn btn-warning btn-sm">删除</span></a>&nbsp
        </td>
    </tr>
    <?php if(!empty($model['-'])){ ?>
        <?= $this->render('tree', [
            'models'=>$model['-'],
            'parent_title' =>$model['title'],
        ])?>
    <?php } ?>
<?php } ?>