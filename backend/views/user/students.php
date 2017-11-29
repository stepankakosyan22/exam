<?php

use yii\helpers\Html;

$this->title = 'Student';
?>
    <a class="add_admin btn" href="/user/createstudent">Add Student</a>


    <div style="width:100%;margin-bottom: 15px;display: flex" >
        <input class="form-control" id="studentSearchInput" type="text" placeholder="Search.."
               style="width:25%;float:right;margin-right: 10px;">
        <select id="select_filter" class="form-control pull-left" style="width:15%">
            <option>By group</option>
            <?php foreach ($groups as $group){ ?>
                <option value="<?= $group['id_group'] ?>"><?= $group['group_name'] ?></option>
            <?php }?>
        </select>
        <div style="margin-left:10px;display: flex">
            <label class="contain">Enable
                <input type="radio" name="radio" class="abled" value="enable">
                <span class="checkmark"></span>
            </label>
            <label class="contain">Disable
                <input type="radio"  name="radio" class="abled"  value="disable">
                <span class="checkmark"></span>
            </label>
        </div>
    </div>

<?php if ($students) { ?>
    <table class="table table-hover">
        <tr>
            <th>Full name</th>
            <th>Group</th>
        </tr>

        <?php foreach ($students as $student) { ?>
            <tbody id="StudentTableItem">
                <tr class="searchbar_item group<?=$student->group ?> <?php if ($student->enable==1){ echo 'enable'; }elseif($student->enable==0){ echo 'disable'; }?>">
                    <td onclick="window.location='/user/view/<?= $student->id ?>'"
                        style="cursor: pointer"><?= $student->name ?> <?= $student->surname ?></td>
                    <td>
                        <?php foreach ($groups as $group) {
                            if ($group['id_group'] == $student->group) {
                                    echo $group['group_name'];
                                }
                             } ?>
                        <a href="/user/editstudent/<?= $student->id ?>">
                            <span style="cursor:pointer; font-size: 120%;margin:3px;"
                                  class="glyphicon glyphicon-edit pull-right"></span>
                        </a>
                        <?= Html::a('', ['/user/studentdelete', 'id' => $student->id], [
                            'class' => 'glyphicon glyphicon-remove pull-right',
                            'style' => 'font-size: 120%;color: maroon;cursor:pointer;margin:3px',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
<?php } ?>