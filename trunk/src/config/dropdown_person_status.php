<?php $listPersonStatus = List_PersonStatus(); ?>
<select id="form-s-s" name="person_status">                        
    <?php foreach ($listPersonStatus as $key => $data): ?>
        <?php if ($person_status == $key): ?>
            <option value="<?= $key ?>" selected><?= $data ?></option>
        <?php else : ?>
            <option value="<?= $key ?>"><?= $data ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>
