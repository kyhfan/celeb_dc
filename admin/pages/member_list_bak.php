<?
    include_once "header.php";
    $m_list_query   = "SELECT * FROM ".$_gl['member_info_table']." WHERE 1 ORDER BY idx DESC";
    $m_list_result    = mysqli_query($my_db, $m_list_query);
?>
  <body>
  <h3>회원 리스트</h3>
  <hr>
  <table class="member_list table table-bordered" style="text-align:center;">
    <tr style="color:#fff;background-color:#999;">
      <td><input type="checkbox" name="all_check" id="all_check"></td>
      <td>번호</td>
      <td>아이디</td>
      <td>이름</td>
      <td>등급</td>
      <td>회원가입일시</td>
      <td>최종로그인</td>
      <td>메일/SMS 발송</td>
      <td>정보수정</td>
    </tr>
<?
    while ($row = mysqli_fetch_array($m_list_result)) {
      $i++;
?>
  <tr>
    <td><input type="checkbox" name="one_check" id="one_check"></td>
    <td><?=$i?></td>
    <td><?=$row['mb_id']?></td>
    <td><?=$row['mb_name']?></td>
    <td><?=$row['mb_grade']?></td>
    <td><?=$row['mb_join_date']?></td>
    <td><?=$row['mb_login_date']?></td>
    <td><input type="button" id="send_mail" onclick="send();" value="메일">&nbsp;
        <input type="button" id="send_sms" onclick="send();" value="SMS">
    </td>
    <td><input type="button" id="modify" onclick="action('modify', '<?=$row['mb_id']?>');" value="수정"></td>
  </tr>
<?
    }
?>
  </table>
  <script type="text/javascript">
    function action(type, mb_id){
      if(type=='modify') {
      location.href="modify_form.php?mb_id="+mb_id;
      }
    }
  </script>
  </body>
  </html>