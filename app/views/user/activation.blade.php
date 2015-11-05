<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Verify Your Email Address</h2>
<table class="container-middle" align="center" border="0" cellpadding="0" cellspacing="0" width="560" bgcolor="F1F2F7">
    <tbody><tr>
        <td>
            <table class="mainContent" align="center" border="0" cellpadding="0" cellspacing="0" width="528">
                <tbody><tr><td height="20"></td></tr>
                <tr>
                    <td>

                        <table class="section-item" align="left" border="0" cellpadding="0" cellspacing="0" width="360">
                            <tbody><tr>
                                <td style="color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">

                                    Sign Up Confirmation

                                </td>
                            </tr>
                            <tr><td height="15"></td></tr>
                            <tr>
                                <td style="color: #a4a4a4; line-height: 25px; font-size: 12px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">

                                    <div>
                                        Dear <b>{{ $fullName }}</b>, thanks for creating an account.
                                        Please follow the link below to verify your account
                                        .<br/>

                                    </div>

                                </td>
                            </tr>
                            <tr><td height="15"></td></tr>
                            <tr>
                                <td>
                                    <a href="{{ URL::to('register/activation/'.$confirmation_code) }}" style="background-color: #7087A3; font-size: 12px; padding: 10px 15px; color: #fff; text-decoration: none"> Activate</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>


                        <table align="left" border="0" cellpadding="0" cellspacing="0">
                            <tbody><tr><td height="30" width="30"></td></tr>
                            </tbody>
                        </table>


                        <table class="section-item" align="left" border="0" cellpadding="0" cellspacing="0">
                            <tbody><tr><td height="6"></td></tr>
                            <tr>
                                <td><a href="" style="width: 128px; display: block;">{{ HTML::image('img/email-img/image1.png', 'alt', array( 'width' => 35, 'height' => 35 )) }}</a></td>
                            </tr>
                            <tr><td height="10"></td></tr>
                            </tbody>
                        </table>


                    </td>
                </tr>

                <tr><td height="20"></td></tr>

                </tbody></table>
        </td>
    </tr>


    </tbody></table>

</body>
</html>
