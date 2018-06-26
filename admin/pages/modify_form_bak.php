<?
    include_once "header.php";
    $select_query   = "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_id='".$_REQUEST['userid']."'";
    $select_result    = mysqli_query($my_db, $select_query);
    $select_data = mysqli_fetch_array($select_result);
    $split_email = explode('@', $select_data['mb_email']);
    $split_birth = explode('/', $select_data['mb_birth']);
    $split_phone = explode('-', $select_data['mb_handphone']);
    $split_tel = explode('-', $select_data['mb_telphone']);
?>
  <body>
    <form action="./member_info_admin.php" method="post" onsubmit="return validate();">
      <h3>기본 정보</h3>
      <strong>아이디 * :</strong> <input type="text" id="userid" name="userid" value="<?=$select_data['mb_id']?>" readonly="true"> 
      <br>
      <strong>비밀번호 * :</strong> <input type="password" id="password" name="password"> 영문 대소문자, 최소 1개의 숫자/ 특수 문자 포함
      <br>
      <strong>비밀번호 확인 * :</strong> <input type="password" id="passchk">
      <br>
      <strong>비밀번호 확인 질문 * :</strong>
      <select id="password_Q" name="password_Q">
        <option <? if($select_data['mb_question'] == 1) echo 'selected'; ?> value="1">기억에 남는 추억의 장소는?</option>
        <option <? if($select_data['mb_question'] == 2) echo 'selected'; ?> value="2">자신의 인생 좌우명은?</option>
        <option <? if($select_data['mb_question'] == 3) echo 'selected'; ?> value="3">자신의 보물 제1호는?</option>
      </select>
      <br>
      <strong>비밀번호 확인 답변 * :</strong> 
      <input type="text" id="password_A" name="password_A" value="<?=$select_data['mb_answer']?>">
      <br>
      <strong>이름 * :</strong> <input type="text" id="username" name="username" value="<?=$select_data['mb_name']?>" style="ime-mode:active">
      <br>
      <strong>등급 * :</strong> 
      <select id="grade" name="grade">
        <option <? if($select_data['mb_grade'] == 'silver') echo 'selected'; ?> value="silver">sliver</option>
        <option <? if($select_data['mb_grade'] == 'gold') echo 'selected'; ?> value="gold">gold</option>
        <option <? if($select_data['mb_grade'] == 'vip') echo 'selected'; ?> value="vip">vip</option>
      </select>
      <br>
      <strong>주소 * :</strong> <input type="text" name="zipcode" id="zipcode" value="<?=$select_data['mb_zipcode']?>"> 
      <button onclick="daum_postcode();return false;">주소검색</button>
      <br>
      <input type="text" name="addr1" id="addr1" value="<?=$select_data['mb_address1']?>" size="30"> 기본주소
      <br>
      <input type="text" name="addr2" id="addr2" value="<?=$select_data['mb_address2']?>"> 나머지주소
      <br>
      <strong>휴대전화 * :</strong>
      <select id="phone1" name="phone1">
        <option <? if($split_phone[0] == '010') echo 'selected'; ?> value="010">010</option>
        <option <? if($split_phone[0] == '011') echo 'selected'; ?> value="011">011</option>
        <option <? if($split_phone[0] == '016') echo 'selected'; ?> value="016">016</option>
        <option <? if($split_phone[0] == '017') echo 'selected'; ?> value="017">017</option>
        <option <? if($split_phone[0] == '018') echo 'selected'; ?> value="018">018</option>
        <option <? if($split_phone[0] == '019') echo 'selected'; ?> value="019">019</option>
      </select>
      - <input type="text" id="phone2" name="phone2" value="<?=$split_phone[1]?>"> - <input type="text" id="phone3" name="phone3" value="<?=$split_phone[2]?>">
      <br>
      <strong>SMS 수신여부 * :</strong>
      <input type="radio" name="smsYN" <? if($select_data['mb_smsYN'] == 'Y') echo 'checked'; ?> value="Y">수신함
      <input type="radio" name="smsYN" <? if($select_data['mb_smsYN'] == 'N') echo 'checked'; ?> value="N">수신안함
      <br>
      <strong>이메일 * :</strong>
      <input type="text" id="email1" name="email1" value="<?=$split_email[0]?>"> @ <input type="text" id="email2" name="email2" value="<?=$split_email[1]?>" readonly="true"> 
      <select id="email3" onchange="auto_insert();return false;">
        <option>이메일 선택</option>
        <option value="gmail.com">gmail.com</option>
        <option value="naver.com">naver.com</option>
        <option value="hanmail.net">hanmail.net</option>
        <option>직접입력</option>
      </select>
      <br>
      <strong>이메일 수신여부 * :</strong>
      <input type="radio" name="emailYN" <? if($select_data['mb_emailYN'] == 'Y') echo 'checked'; ?> value="Y">수신함
      <input type="radio" name="emailYN" <? if($select_data['mb_emailYN'] == 'N') echo 'checked'; ?> value="N">수신안함
      <br><br>
      <h3>추가 정보</h3><br>
      <strong>생년월일 :</strong> 
      <input type="text" name="birthY" id="birthY" value="<?=$split_birth[0]?>">년<input type="text" name="birthM" id="birthM" value="<?=$split_birth[1]?>">월<input type="text" name="birthD" id="birthD" value="<?=$split_birth[2]?>">일
      <br><br>
      <strong>일반전화 :</strong>
      <select id="tel1" name="tel1">
        <option <? if($split_tel[0] == '02') echo 'selected'; ?> value="02">02</option>
        <option <? if($split_tel[0] == '031') echo 'selected'; ?> value="031">031</option>
        <option <? if($split_tel[0] == '032') echo 'selected'; ?> value="032">032</option>
      </select>
      - <input type="text" id="tel2" name="tel2" value="<?=$split_tel[1]?>"> - <input type="text" id="tel3" name="tel3" value="<?=$split_tel[2]?>">
      <br><br>
      <strong>성별</strong>
      <input type="radio" name="gender" <? if($select_data['mb_gender'] == 'M') echo 'checked'; ?> value="M">남
      <input type="radio" name="gender" <? if($select_data['mb_gender'] == 'F') echo 'checked'; ?> value="F">여
      <br><br>
      <button type="submit">수정</button>&nbsp;&nbsp;&nbsp;
      <button type="reset">취소</button>
    </form>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <script type="text/javascript">
      function daum_postcode() {
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
      }

      function validate() {
          // var userid = document.getElementById('userid');
          var password = document.getElementById('password');
          var passchk = document.getElementById('passchk');
          var username = document.getElementById('username');
          var zipcode = document.getElementById('zipcode');
          var addr1 = document.getElementById('addr1');
          var addr2 = document.getElementById('addr2');
          var password_Q = document.getElementById('password_Q');
          var password_A = document.getElementById('password_A');
          var email1 = document.getElementById('email1');
          var email2 = document.getElementById('email2');
          var tel1 = document.getElementById('tel1');
          var tel2 = document.getElementById('tel2');
          var tel3 = document.getElementById('tel3');
          var phone1 = document.getElementById('phone1');
          var phone2 = document.getElementById('phone2');
          var phone3 = document.getElementById('phone3');

          // 비밀번호 검사
          // 영문 대소문자
          // 최소 1개의 숫자 혹은 특수 문자를 포함해야 함
          // if(!chk(/^(?=.*[a-zA-Z])((?=.*\d)|(?=.*\W)).{4,12}$/, password, "비밀번호에 대소문자, 최소 1개의 숫자/ 특수 문자 포함"))
          //        return false;

          if(!chk(/^[a-zA-Z0-9]{4,12}$/, password, "비밀번호는 숫자, 영문자 혼합으로 4~12자 입력할것"))
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

          // if (tel1.value != '') {
          //        if (!chk(/^[0-9]{3,}$/, tel2, "번호 3자리 이상 입력"))
          //                return false;
          //        if (!chk(/^[0-9]{4}$/, tel3, "4자리 번호 입력"))
          //                return false;
          //        }

          if (phone1.value != '') {
                 if (!chk(/^[0-9]{3,}$/, phone2, "번호 3자리 이상 입력"))
                         return false;
                 if (!chk(/^[0-9]{4}$/, phone3, "4자리 번호 입력"))
                         return false;
                 }

          if (email1.value != '') {
                email1.value = email1.value+'@'+email2.value;
                if(!chk(/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/, email1, "이메일 주소가 올바르지 않습니다."))
                   return false;
                 }
        }


          // 전체 공백 체크



      function chk(re, e, msg) {
             if (re.test(e.value)) {
                 return true;
             }

             alert(msg);
             e.value = "";
             e.focus();
             return false;
      }

      function auto_insert() {
        $('#email2').attr('readonly', false);
        var mail = $('#email3').val();
        if(mail=="직접입력") {
          $('#email2').val('').focus();
        }else{
          $('#email2').empty().val(mail);
          $('#email2').attr('readonly', true);
        }
      }

    </script>
  </body>
</html>