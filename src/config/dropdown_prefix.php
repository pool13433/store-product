<?php
$sql_prefix = "SELECT * FROM prefix ORDER BY pre_id ASC";
$query_prefix = mysql_query($sql_prefix) or die(mysql_error());
?>
<select id="select-prefix" name="prefix"
        data-validation-engine="validate[required]"
        data-errormessage-value-missing="กรุณาเลือก คำนำหน้าชื่อ">
    <option value="">--เลือก--</option>
    <?php while ($row = mysql_fetch_array($query_prefix)): ?>
        <?php if ($prefix == $row['pre_id']): ?>
            <option value="<?= $row['pre_id'] ?>" selected><?= $row['pre_name'] ?></option>
        <?php else : ?>
            <option value="<?= $row['pre_id'] ?>"><?= $row['pre_name'] ?></option>
        <?php endif; ?>
    <?php endwhile; ?>
</select>


