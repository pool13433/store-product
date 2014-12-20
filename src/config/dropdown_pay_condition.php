<?php $listPersonStatus = List_PersonStatus(); ?>
<select id="form-s-s" name="pay_condition"
         data-validation-engine="validate[required]"
         data-errormessage-value-missing="กรุณากรอก เงื่อนไขการจ่ายเงิน">
    <?php foreach ($listPersonStatus as $key => $data): ?>
        <?php if ($pay_condition == $key): ?>
            <option value="<?= $key ?>" selected><?= $data ?></option>
        <?php else : ?>
            <option value="<?= $key ?>"><?= $data ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>

