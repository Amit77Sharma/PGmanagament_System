<?php
include 'header.php';

$ip=getUserIpAddr();
$currentDateTime = date('Y-m-d H:i:s');
if(isset($_GET['id'])&&isset($_GET['otp']))
{
    $_SESSION['email']=$email=$conn->query("select * from tbl_login_details where id=".$_GET['id'])->fetch_assoc()['email'];
    $otp=generateNumericOTP(6);
    $qryotp=$conn->query("insert into tbl_otp_mstr (id,email,otp,datetime,ip,status) values (0,'$email','$otp','".strtotime($currentDateTime)."','$ip',0)");
    if($qryotp==true)
    {
      $otp_id=$conn->insert_id;
      $_SESSION['otp_id']=$otp_id;
      $body='Your OTP is: <b>'.$otp.'</b> .';
      $subject='OTP To Confirm Your Email';
      $from='ajtechnicalworks@gmail.com';
      $from_name='Sawagtam';
      if(smtpmailer($email, $from, $from_name, $subject, $body)==true)
      {
        if(isset($_GET['forget']))
        {
         header('Location:otp.php?id='.$_GET["id"].'&forget=1'); 
        }
        else
        {
          header('Location:otp.php?id='.$_GET["id"]);
        }
      }
      else
      {
        $conn->query("insert into fault (id,login_id,fault_on,details,on_page,status)values(0,".$_GET['id'].",'Email Sending','Not able to send mail','otp.php',0)");
        ?><script type="text/javascript">alert('Something went wrong !!! Try after some time');
            window.location='index.php';
        </script><?php
      }
    }
    else
    {
        $conn->query("insert into fault (id,login_id,fault_on,details,on_page,status)values(0,".$_GET['id'].",'OTP Data Insertion','Not able to insert data','otp.php',0)");
        ?><script type="text/javascript">alert('Something went wrong !!! Try after some time');
            window.location='index.php';
        </script><?php
    }
}
if(isset($_POST['submit']))
{
  $timestamp=strtotime($currentDateTime)-1200;
  if(mysqli_num_rows($conn->query("select * from tbl_otp_mstr where id=".$_SESSION['otp_id']." and email='".$_POST['username']."' and otp='".$_POST['otp']."' and datetime>='$timestamp' and status=0"))>=1)
  {
    if($conn->query("update tbl_login_details set status=1 where id=".$_GET['id'])==true)
    {
      session_unset();
      session_destroy();
      ?>
      <script type="text/javascript">
        alert("Verified and Activated\nLogin Now");
        window.location='loginpage.php';
      </script>
      <?php
    }
  }
  else
  {
    $msg='Worng OTP !!!';
  }
}
?>
<div id="absoluteCenteredDiv" style="margin-top: 15%; border-radius: 20px;" >
    <form action="<?php if(isset($_GET['forget'])){ echo 'change_pass.php'; } ?>" method="post">
        <div class="box">
            <h1>Verify One Time Password</h1>
            <?php $a=$_SESSION['email'].'0'; ?>
            <p>OTP Sent to : <?php $i=0; while($a[$i]!='@') { if($i<4) { echo $a[$i]; }else{ echo 'x'; } $i++; } while($a[$i]){ echo $_SESSION['email'][$i]; $i++; } ?> <!--?<a href="">Change</a>--></p>
              <?php if(isset($msg)){ ?><p style="color:red;"><?=$msg;?></p> <?php } ?>
            <input class="username" name="username" type="text" placeholder="Email">
            <?php if(isset($_GET['forget'])){ ?><input class="hidden" type="hidden" value="<?=$_GET['id'];?>" name="id"><?php } ?>
            <input class="username" name="otp" type="password" placeholder="6 digit OTP">
            <a href="#"><input type="submit" name="submit" value="Verify" class="button btn btn-primary"></a>
        </div>
    </form>
    <div class="col-sm-12 col-md-12 col-lg-12" style="padding-left: 100px;"><div style="text-align: left;" class="col-sm-10 col-md-10 col-lg-10"><p>Don't Get OTP ? <a class="fpwd" href="?id=<?=$_GET['id'];?>&otp=send" id="codespeedy">Resend !</a></p></div><div style="text-align: left;margin-left: -120px;" class="col-sm-2 col-md-2 col-lg-2" id="timer"></div></div>
</div>
<?php
include 'footer.html';
    ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#codespeedy').hide().delay(20000).fadeIn('slow');
    $('#timer').show().delay(20000).fadeOut('slow');
  });
</script>
<script type="text/javascript">
    // Credit: Mateusz Rybczonec
const TIME_LIMIT = 20;
let timePassed = 0;
let timeLeft = TIME_LIMIT;

let timerInterval = null;

document.getElementById("timer").innerHTML = `
<div class="base-timer">
  <span id="base-timer-label" class="base-timer__label">${formatTime(
    timeLeft
  )}</span>
</div>
`;

startTimer();

function onTimesUp() {
  clearInterval(timerInterval);
}

function startTimer() {
  timerInterval = setInterval(() => {
    timePassed = timePassed += 1;
    timeLeft = TIME_LIMIT - timePassed;
    document.getElementById("base-timer-label").innerHTML = formatTime(
      timeLeft
    );

    if (timeLeft === 0) {
      onTimesUp();
    }
  }, 1000);
}

function formatTime(time) {
  const minutes = Math.floor(time / 60);
  let seconds = time % 60;

  if (seconds < 10) {
    seconds = `0${seconds}`;
  }

  return `${minutes}:${seconds}`;
}

function calculateTimeFraction() {
  const rawTimeFraction = timeLeft / TIME_LIMIT;
  return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
}
</script>