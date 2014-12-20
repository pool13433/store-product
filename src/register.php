<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <form class="uk-form uk-form-horizontal" id="frm-register">
        <fieldset data-uk-margin>
            <legend>กรอกข้อมูลความปลอดภัย</legend>
            <div class="uk-form-row">
                <label for="input-username" class="uk-form-label">Username</label>
                <div class="uk-form-controls">
                    <input type="text" name="username" id="input-username" 
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก username" 
                           />
                </div>
            </div>
            <div class="uk-form-row">
                <label for="input-password" class="uk-form-label">Password</label>
                <div class="uk-form-controls">
                    <input type="password" name="password" id="input-password" 
                           data-validation-engine="validate[required,minSize[6]]"
                           data-errormessage-value-missing="กรุณากรอก password" 
                           data-errormessage-range-underflow="กรุณากรอกข้อมูล รหัสผ่านอย่างน้อย 6 ตัวอักษร"
                           />
                </div>
            </div>
            <div class="uk-form-row">
                <label for="input-repassword" class="uk-form-label">ยืนยัน Password</label>
                <div class="uk-form-controls">
                    <input type="password" name="repassword" id="input-repassword"                            
                           data-validation-engine="validate[required,minSize[6],equals[input-password]]"
                           data-errormessage-value-missing="กรุณากรอก password" 
                           data-errormessage-range-underflow="กรุณากรอกข้อมูล รหัสผ่านอย่างน้อย 6 ตัวอักษร"
                           data-errormessage-pattern-mismatch="กรุณากรอกข้อมูล รหัสผ่านให้ตรงกัน"
                           />
                </div>
            </div>
        </fieldset>
        <fieldset data-uk-margin>
            <legend>กรอกข้อมูลส่วนตัว</legend>
            <div class="uk-form-row">
                <label for="input-fname" class="uk-form-label">ชื่อจริง</label>
                <div class="uk-form-controls">
                    <input type="text" name="fname" id="input-fname" 
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก ชื่อ" />
                </div>
            </div>
            <div class="uk-form-row">
                <label for="input-lname" class="uk-form-label">นามสกุล</label>
                <div class="uk-form-controls">
                    <input type="text" name="lname" id="input-lname" 
                           data-validation-engine="validate[required]"
                           data-errormessage-value-missing="กรุณากรอก นามสกุล" />
                </div>
            </div>            
            <div class="uk-form-row">
                <label for="input-address" class="uk-form-label">ที่อยู่</label>
                <div class="uk-form-controls">
                    <textarea  rows="5" cols="50" name="address" id="input-address" 
                               data-validation-engine="validate[required]"
                               data-errormessage-value-missing="กรุณากรอก ที่อยู่" 
                               ></textarea>
                </div>
            </div>         
            <div class="uk-form-row">
                <label for="input-mobile" class="uk-form-label">โทรศัพท์</label>
                <div class="uk-form-controls">
                    <input type="text" name="mobile" id="input-mobile" 
                           data-validation-engine="validate[required,minSize[10]]"
                           data-errormessage-value-missing="กรุณากรอก โทรศัพท์" 
                           data-errormessage-range-underflow="กรุณากรอกโทรศัพท์ ให้ครบ"/>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="input-email" class="uk-form-label">อีเมมล์</label>
                <div class="uk-form-controls">
                    <input type="text" name="email" id="input-email" 
                           data-validation-engine="validate[required,custom[email]]"
                           data-errormessage-value-missing="กรุณากรอก อีเมมล์" 
                           data-errormessage-custom-error="กรุณากรอกอีเมมล์ ให้ถูกต้อง"/>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-form-controls">
                    <button class="uk-button-primary uk-button-large" type="submit">
                        <i class="uk-icon-save"></i> บันทึก
                    </button>
                    <button class="uk-button-danger uk-button-large" type="button">
                        <i class="uk-icon-arrow-circle-left"></i> ยกเลิก
                    </button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var valid = $('#frm-register').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status == true)
                    PostJson('frm-register', './database/db_person.php?method=register');
            }
        });
        valid.css({
          'box-shadow': '2px 2px 2px 2px #888888',
          'padding' : '20px',
        });
    });
</script>