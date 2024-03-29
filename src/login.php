<div class="uk-vertical-align uk-text-center uk-height-1-1">
    <div class="uk-vertical-align-middle" style="width: 250px;">       
        <img class="uk-margin-bottom" width="140" height="120" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMTQwcHgiIGhlaWdodD0iMTIwcHgiIHZpZXdCb3g9Ii0yOS41IDI3NS41IDE0MCAxMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgLTI5LjUgMjc1LjUgMTQwIDEyMCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0tNi4zMzMsMjk4LjY1NHY3My42OTFoOTMuNjY3di03My42OTFILTYuMzMzeiBNNzkuNzg4LDM2NC4zNTVIMS42NTZ2LTU3LjcwOWg3OC4xMzJWMzY0LjM1NXoiLz4NCgk8cG9seWdvbiBmaWxsPSIjRDhEOEQ4IiBwb2ludHM9IjUuODYsMzU4LjE0MSAyMS45NjIsMzQxLjIxNiAyNy45OTUsMzQzLjgyNyA0Ny4wMzIsMzIzLjU2MSA1NC41MjQsMzMyLjUyMyA1Ny45MDUsMzMwLjQ4IA0KCQk3Ni4yMDMsMzU4LjE0MSAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iMjQuNDYyIiBjeT0iMzIxLjMyMSIgcj0iNy4wMzQiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
        <form class="uk-panel uk-panel-box uk-form" id="frm-login">
            <div class="uk-form-row">
                <input class="uk-width-1-1 uk-form-large" name="username" type="text" placeholder="Username"
                       data-validation-engine="validate[required]"
                       data-errormessage-value-missing="กรุณากรอก username"/>
            </div>
            <div class="uk-form-row">
                <input class="uk-width-1-1 uk-form-large" name="password" type="text" placeholder="Password"
                       data-validation-engine="validate[required]"
                       data-errormessage-value-missing="กรุณากรอก password"/>
            </div>
            <div class="uk-form-row">
                <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large">
                    <i class="uk-icon-sign-in"></i> เข้าใช้งานระบบ
                </button>
            </div>
            <div class="uk-form-row uk-text-small">
                <label class="uk-float-left"><input type="checkbox"> Remember Me</label>
                <a class="uk-float-right uk-link uk-link-muted" href="#">Forgot Password?</a>
            </div>
        </form>
    </div>    
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var valid = $('#frm-login').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                if (status == true)
                    $.ajax({
                        url: './database/db_person.php?method=login',
                        data: $('#frm-login').serialize(),
                        type: 'post',
                        dataType: 'json',
                        success: function(data) {
                            console.log(' data ' + data);
                            if (data.status == 'success') {
                                uk_notify(data.msg, 'success', 5);
                                redirectDelay(data.url, 3);
                            } else {
                                uk_notify(data.msg, 'danger', 5);
                            }
                        }
                    });
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>

