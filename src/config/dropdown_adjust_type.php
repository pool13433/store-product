<?php $listAdjust = List_Adjust(); ?>
<select id="form-s-s" name="adjust_type"
        class="validate[required]"
        data-errormessage-value-missing="กรุณาเลือก ประเภท">
            <?php foreach ($listAdjust as $key => $data): ?>
        <option value="<?= $key ?>"><?= $data ?></option>
    <?php endforeach; ?>
</select>

