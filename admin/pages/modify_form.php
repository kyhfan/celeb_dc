<?
	include_once "header.php";
	$userid = $_REQUEST['userid'];
	$user_query = "SELECT mb_id,mb_name,mb_handphone,mb_telphone,mb_zipcode,mb_address1,mb_address2,mb_birth,mb_email,mb_emailYN,mb_smsYN,mb_grade FROM ".$_gl['member_info_table']." WHERE mb_id='".$userid."'";
	$user_result = mysqli_query($my_db, $user_query);
	$user_data = mysqli_fetch_array($user_result);

	$split_email = explode('@', $user_data['mb_email']);
	$split_birth = explode('/', $user_data['mb_birth']);
	$split_phone = explode('-', $user_data['mb_handphone']);
	$split_tel = explode('-', $user_data['mb_telphone']);
?>
<link href="../../lib/filer/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="../../lib/filer/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<body>

<div id="wrapper">
  <!-- Navigation -->
  <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">쇼핑몰 관리자</a>
    </div>
  <!-- /.navbar-header -->

<?
	include_once "top_navi.php";
	include_once "side_navi.php";
?>
</div>
<!-- /.navbar-static-side -->
  </nav>
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">회원 정보 수정</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <form method="post" id="modify_form" role="form">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="col-sm-2">아이디</label>
                    <input class="form-control" type="text" id="user_id" name="user_id" value="<?=$user_data['mb_id']?>" disabled>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">비밀번호</label>
                    <input class="form-control" type="password" id="password" name="password">
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">비밀번호 확인</label>
                    <input class="form-control" type="password" id="passchk">
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">이름</label>
                    <input class="form-control" type="text" id="username" name="username" value="<?=$user_data['mb_name']?>">
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">주소</label>
                    <input class="form-control" type="text" name="zipcode" id="zipcode" value="<?=$user_data['mb_zipcode']?>" readonly>
                    <input class="form-control" type="button" id="find_addr" value="주소검색">
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2"></label>
                    <input class="form-control" type="text" name="addr1" id="addr1" value="<?=$user_data['mb_address1']?>" readonly>
                    <input class="form-control" type="text" name="addr2" id="addr2" value="<?=$user_data['mb_address2']?>">
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">휴대전화</label>
                    <select class="form-control" id="phone1" name="phone1">
                      <option <? if($split_phone[0] == '010') echo 'selected'; ?> value="010">010</option>
                      <option <? if($split_phone[0] == '011') echo 'selected'; ?> value="011">011</option>
                      <option <? if($split_phone[0] == '016') echo 'selected'; ?> value="016">016</option>
                      <option <? if($split_phone[0] == '017') echo 'selected'; ?> value="017">017</option>
                      <option <? if($split_phone[0] == '018') echo 'selected'; ?> value="018">018</option>
                      <option <? if($split_phone[0] == '019') echo 'selected'; ?> value="019">019</option>
                    </select>
                    - <input class="form-control" type="text" id="phone2" name="phone2" value="<?=$split_phone[1]?>" size="10">
                    - <input class="form-control" type="text" id="phone3" name="phone3" value="<?=$split_phone[2]?>" size="10">
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">SMS 수신여부</label>
                    <div class="radio">
                      <label>
                        <input type="radio" id="smsY" name="smsYN" <? if($user_data['mb_smsYN'] == 'Y') echo 'checked'; ?> value="Y">수신함
                      </label>
                      <label>
                        <input type="radio" id="smsN" name="smsYN" <? if($user_data['mb_smsYN'] == 'N') echo 'checked'; ?> value="N">수신안함
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">이메일</label>
                    <input class="form-control" type="text" id="email1" name="email1" value="<?=$split_email[0]?>"> <span>@</span> 
                    <input class="form-control" type="text" id="email2" name="email2" value="<?=$split_email[1]?>" disabled>
                    <select class="form-control" id="email3">
                      <option value="direct">직접입력</option>
                      <option value="gmail.com">gmail.com</option>
                      <option value="naver.com">naver.com</option>
                      <option value="hanmail.net">hanmail.net</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">이메일 수신여부</label>
                    <div class="radio">
                      <label>
                        <input type="radio" id="emailY" name="emailYN" <? if($user_data['mb_emailYN'] == 'Y') echo 'checked'; ?> value="Y">수신함
                      </label>
                      <label>
                        <input type="radio" id="emailN" name="emailYN" <? if($user_data['mb_emailYN'] == 'N') echo 'checked'; ?> value="N">수신안함
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="col-sm-2">생년월일</label>
                    <input class="form-control" type="text" name="birthY" id="birthY" value="<?=$split_birth[0]?>" size="10"> <span>년</span> 
                    <input class="form-control" type="text" name="birthM" id="birthM" value="<?=$split_birth[1]?>" size="10"> <span>월</span> 
                    <input class="form-control" type="text" name="birthD" id="birthD" value="<?=$split_birth[2]?>" size="10"> <span>일</span>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">일반전화</label>
                    <select class="form-control" id="tel1" name="tel1">
                      <option <? if($split_tel[0] == '02') echo 'selected'; ?> value="02">02</option>
                      <option <? if($split_tel[0] == '031') echo 'selected'; ?> value="031">031</option>
                      <option <? if($split_tel[0] == '032') echo 'selected'; ?> value="032">032</option>
                    </select>
                    <span>-</span> <input class="form-control" type="text" id="tel2" name="tel2" value="<?=$split_tel[1]?>" size="10"> <span>-</span> <input class="form-control" type="text" id="tel3" name="tel3" value="<?=$split_tel[2]?>" size="10">
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">등급</label>
                    <select class="form-control" id="grade" name="grade">
                      <option <? if($user_data['mb_grade'] == 'silver') echo 'selected'; ?> value="silver">silver</option>
                      <option <? if($user_data['mb_grade'] == 'gold') echo 'selected'; ?> value="gold">gold</option>
                      <option <? if($user_data['mb_grade'] == 'vip') echo 'selected'; ?> value="vip">vip</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group" style="text-align:center;">
                      <input class="form-control" type="button" id="submit" value="수정">
                      <input class="form-control" type="reset" value="취소">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.row (nested) -->
          </div>
          <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript">
	var check;
	$('#find_addr').on('click', function() {
		new daum.Postcode({
			oncomplete: function(data) {
				// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

				// 각 주소의 노출 규칙에 따라 주소를 조합한다.
				// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
				var fullAddr = ''; // 최종 주소 변수
				var extraAddr = ''; // 조합형 주소 변수

				// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
				if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
					fullAddr = data.roadAddress;

				} else { // 사용자가 지번 주소를 선택했을 경우(J)
					fullAddr = data.jibunAddress;
				}

				// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
				if(data.userSelectedType === 'R'){
					//법정동명이 있을 경우 추가한다.
					if(data.bname !== ''){
						extraAddr += data.bname;
					}
					// 건물명이 있을 경우 추가한다.
					if(data.buildingName !== ''){
						extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
					}
					// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
					fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
				}

				// 우편번호와 주소 정보를 해당 필드에 넣는다.
				document.getElementById('zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('addr1').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('addr2').focus();
			}
		}).open();
	});
	$('#email3').on('change', function(){
		$('#email2').attr('disabled', false);
		var mail = $('#email3').val();
		if(mail=="direct") {
			$('#email2').val('').focus();
		}else{
			$('#email2').val('').val(mail);
			$('#email2').attr('disabled', true);
		}
	});
	$('#submit').on('click', function(){
		check = validate('modify');

		if(check){
			$.ajax({
				method: 'POST',
				url: 'admin_exec.php',
				data: {
					exec     : "member_modify",
					user_id  : user_id.value,
					password  : password.value,
					username  : username.value,
					zipcode  : zipcode.value,
					addr1  : addr1.value,
					addr2  : addr2.value,
					email1  : email1.value,
					email2  : email2.value,
					emailYN  : $(':radio[name="emailYN"]:checked').val(),
					tel1  : tel1.value,
					tel2  : tel2.value,
					tel3  : tel3.value,
					phone1  : phone1.value,
					phone2  : phone2.value,
					phone3  : phone3.value,
					smsYN  : $(':radio[name="smsYN"]:checked').val(),
					birthY  : $('#birthY').val(),
					birthM  : $('#birthM').val(),
					birthD  : $('#birthD').val(),
					grade   : $('#grade').val()
				},
				success: function(res){
					if(res=='Y'){
						alert("수정 성공");
						location.href='./member_list.php';
					}else{
						alert("수정 실패");
					}
				}
			});
		}
	});
	function validate(ref)
	{
		var user_id = document.getElementById('user_id');
		var password = document.getElementById('password');
		var passchk = document.getElementById('passchk');
		var username = document.getElementById('username');
		var zipcode = document.getElementById('zipcode');
		var addr1 = document.getElementById('addr1');
		var addr2 = document.getElementById('addr2');
		var email1 = document.getElementById('email1');
		var email2 = document.getElementById('email2');
		var tel1 = document.getElementById('tel1');
		var tel2 = document.getElementById('tel2');
		var tel3 = document.getElementById('tel3');
		var phone1 = document.getElementById('phone1');
		var phone2 = document.getElementById('phone2');
		var phone3 = document.getElementById('phone3');

		// 아이디 검사
		// 첫 글자는 반드시 영문 소문자, 4~12자로 이루어지고, 숫자가
		// 하나 이상 포함되어야 한다. 영문소문자와 숫자로만 이루어져야한다.
		// \d : [0-9]와 같다.       {n,m} : n에서 m까지 글자수
		if(ref == 'join'){
			if(!chk(/^[a-z]{1}[a-z0-9]{5,11}$/, user_id, "아이디가 형식에 맞지 않습니다."))
					  return false;
			if(!chk(/[0-9]/, user_id, "아이디에 숫자 하나이상포함!"))
					  return false;
		}

		// 비밀번호 검사
		// 영문 대소문자
		// 최소 1개의 숫자 혹은 특수 문자를 포함해야 함
		// if(!chk(/^(?=.*[a-zA-Z])((?=.*\d)|(?=.*\W)).{4,12}$/, password, "비밀번호에 대소문자, 최소 1개의 숫자/ 특수 문자 포함"))
		//return false;

		if(!chk(/^[a-zA-Z]{1}[a-zA-Z0-9\!\@\#\$\%\^\*\+\=\-]{5,11}$/, password, "비밀번호가 형식에 맞지 않습니다."))
			return false;

		// 비밀번호 확인 검사
		if(password.value!=passchk.value) {
			alert("비밀번호가 틀립니다");
			return false;
		}

		// 이름 검사
		// 2글자 이상, 한글만
		// 통과하지 못하면 한글로 2글자 이상을 넣으세요~ alert 출력!
		if(!chk(/^[가-힝]{2,}$/, username, "이름은 한글로 2글자 이상을 넣으세요."))
			return false;


		// 우편번호, 주소 검사
		if(zipcode.value == '' || addr1.value == '') {
			alert("주소를 입력해주세요.");
			return false;
		}


		// 전화번호 검사

		// 전화번호 앞자리는 2~3자리 숫자, 두번째 자리는 3~4자리 숫자
		// 세번째 자리는 4자리 숫자

		//if (tel1.value != '') {
		//	if (!chk(/^[0-9]{3,}$/, tel2, "번호 3자리 이상 입력"))
		//		return false;
		//		if (!chk(/^[0-9]{4}$/, tel3, "4자리 번호 입력"))
		//		return false;
		//		}

		if (phone1.value != '') {
			if (!chk(/^[0-9]{3,}$/, phone2, "번호 3자리 이상 입력"))
				return false;
			if (!chk(/^[0-9]{4}$/, phone3, "4자리 번호 입력"))
				return false;
		}

		if (email1.value != '') {
			var tmp_email = email1.value;
			email1.value = email1.value+'@'+email2.value;
			if(!chk(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/, email1, "이메일 주소가 올바르지 않습니다."))
				return false;
		}
		email1.value = tmp_email;
		return true;
	}



	function chk(re, e, msg) {
		if (re.test(e.value)) {
			return true;
		}

		alert(msg);
		e.value = "";
		e.focus();
		return false;
	}
</script>

</body>
</html>