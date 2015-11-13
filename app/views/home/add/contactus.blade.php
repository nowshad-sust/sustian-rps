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

                                    Contact US form Mail

                                </td>
                            </tr>
                            <tr><td height="15"></td></tr>
                            <tr>
                                <td style="color: #a4a4a4; line-height: 25px; font-size: 12px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">

                                    <div>
                                        From: <b>{{ $username }}:{{ $email }}</b>
                                        <br/>
                                        Message: {{ $message }}

                                    </div>

                                </td>
                            </tr>
                            <tr><td height="15"></td></tr>
                            <tr>
                                <td>

                                <td>
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
