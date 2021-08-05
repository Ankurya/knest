  <!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
<title>Account Confirm</title>
</head>

<body>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#efefef; margin-top:10px;">
  <tr>
    <td width="20" align="left" valign="top">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20" align="left" valign="top">&nbsp;</td>
        <td align="center" valign="top" style="padding:20px 0;">
        	<a href="javascript:void(0);" style="border:0; outline:0;"><img src="{{$message->embed($logo)}}" alt="" width="100"/></a>
        </td>
        <td width="20" align="left" valign="top">&nbsp;</td>
      </tr>
    </table>
  </td>
  </tr>
  <tr>
    <td height="1" align="left" valign="top" bgcolor="#d9d9d9"></td>
  </tr>
  <tr>
    <td align="left" valign="top" style="background:#efefef; padding:30px 20px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top" style=" font-size:40px; color:#474747;">Hi, {{$user->name}}</b></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
           <tr>
            <td align="center" valign="top" style=" padding:3px; font-family:arial, sans-serif; font-size:18px; color:#474747;">
              You are almost ready.
            </td>
          </tr>
          <tr>
            <td align="center" valign="top" style="padding:3px; font-family:arial, sans-serif; font-size:18px; color:#474747;">
              Simply click the button below to verify your email address.
            </td>
          </tr>
          <tr>
            <td align="center" valign="top" style="padding:3px; font-family:arial, sans-serif; font-size:18px; color:#474747;">
              Thank you, from Knest.
            </td>
          </tr>
          <tr>
            <td height="10" align="left" valign="top"></td>
          </tr>
                 

          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>

          <tr>
            <td align="center" valign="top"> <a href="{{$link}}"; style="border-radius: 5px; font-family:arial, sans-serif; font-size:14px; color:#474747; background-color: #196EA1; padding: 12px 9px; max-width: 120px; display: block; text-align: center; margin: 0 auto; color: #fff; text-decoration: none;">Verify Email</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="40" align="left" valign="top">&nbsp;</td>
      </tr>
    
    </table>
  </td>
  </tr>


  <tr>
    <td align="left" valign="top" style="background:#413e3e; padding:20px; text-align:center;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="top">
        	<a href="http://facebook.com" target="_blank" style="border:0; outline:0; text-decoration:none;"><img src="assets/icon-facebook.png" alt=""/></a> &nbsp;
            <a href="http://twitter.com" target="_blank" style="border:0; outline:0; text-decoration:none;"><img src="assets/icon-twitter.png" alt=""/></a> &nbsp;
            <a href="http://instagram.com" target="_blank" style="border:0; outline:0; text-decoration:none;"><img src="assets/icon-instagram.png" alt=""/></a>
        </td>
      </tr>
      <tr>
        <td align="center" valign="top" style="font-family:arial, sans-serif; font-size:13px; color:#727272; padding-top:10px;">©  Knest {{date('Y')}}</td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
