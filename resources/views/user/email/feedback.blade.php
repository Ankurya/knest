  <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('public/admin/assets/img/apple-icon.png')}}" />
    <link rel="icon" type="image/png" href="{{url('public/admin/assets/img/favicon.png')}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>{{$title}}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

</head>

<body>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#efefef; margin-top:70px;">
  <tr>
    <td width="20" align="left" valign="top">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20" align="left" valign="top">&nbsp;</td>
        <td align="center" valign="top" style="padding:20px 0;">
              <a href="javascript:void(0);" style="border:0; outline:0;"><img src="{{url('public/admin/assets/img/kush.png')}}" alt="" width="100"/></a>
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
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            @php
              $color = $type == 'success' ? '#00c853' : '#b71c1c';
            @endphp
            <td align="center" valign="top" style="font-family:arial, sans-serif; font-size:15px; color:{{$color}};">
              <h3>{{$message}}</h3>
            @if(isset($link))<br><h3><a href="{{$link}}">Click here to login</a></h3>@endif()
            </td>
          </tr>
          <tr>
            <td height="10" align="left" valign="top"></td>
          </tr>
                 

          <tr>
            <td align="left" valign="top">&nbsp;</td>
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
        <!-- <td align="center" valign="top">
          <a href="http://facebook.com" target="_blank" style="border:0; outline:0; text-decoration:none;"><img src="assets/icon-facebook.png" alt=""/></a> &nbsp;
            <a href="http://twitter.com" target="_blank" style="border:0; outline:0; text-decoration:none;"><img src="assets/icon-twitter.png" alt=""/></a> &nbsp;
            <a href="http://instagram.com" target="_blank" style="border:0; outline:0; text-decoration:none;"><img src="assets/icon-instagram.png" alt=""/></a>
        </td> -->
      </tr>
      <tr>
        <td align="center" valign="top" style="font-family:arial, sans-serif; font-size:13px; color:#727272; padding-top:10px;">©  Knest {{date('Y')}}</td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
