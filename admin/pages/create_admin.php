<?
	include_once "header.php";
?>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">관리자계정생성</h3>
          </div>
          <div class="panel-body">
            <form role="form" id="join_frm" method="post">
              <fieldset>
                <div class="form-group">
                  <input class="form-control" placeholder="관리자 아이디" id="admin_id" type="email" autofocus>
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="관리자 비밀번호" id="admin_pw" type="password" value="">
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="관리자 이름" id="admin_name" type="email" value="">
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <a href="#" class="btn btn-lg btn-success btn-block JoinSubmit">관리자 계정 생성</a>
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