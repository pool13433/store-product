<?php $listAdjust = List_Adjust(); ?>
<select id="form-s-s" name="adjust_type"
         class="validate[required]"
         data-errormessage-value-missing="กรุณาเลือก ประเภท">
    <?php foreach ($listAdjust as $key => $data): ?>
        <?php if ($adjust_type == $key): ?>
            <option value="<?= $key ?>" selected><?= $data ?></option>
        <?php else : ?>
            <option value="<?= $key ?>"><?= $data ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>

