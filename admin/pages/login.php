<?
	include_once "header.php";

	if ($_SESSION['ss_admin_id'])
		echo "<script>location.href='index.php'</script>";
?>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">관리자 로그인</h3>
          </div>
          <div class="panel-body">
            <form role="form" id="login_frm" method="post">
              <fieldset>
                <div class="form-group">
                  <input class="form-control" placeholder="관리자 아이디" id="admin_id" type="email" autofocus>
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="관리자 비밀번호" id="admin_pw" type="password" value="">
                </div>
                <div class="checkbox">
                  <label>
                    <input name="remember" type="checkbox" value="ID 저장">ID 저장
                  </label>
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <a href="#" class="btn btn-lg btn-success btn-block loginSubmit">Login</a>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?
	include_once "lib.php";
?>
</body>
</html>