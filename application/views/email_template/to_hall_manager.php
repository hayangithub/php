<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>New Hall Reservation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <style>
            td {
                background-color: rgb(255, 255, 255);
            }
        </style>
    </head>
    <body>
        <div>
            <style>*{margin:0px;padding:0px;}</style>
                <table bgcolor="#FFFFFF" style="border-bottom:1px solid #e0e0e0;width: 100%;margin:0px;">
                   <tr>
                    <td style="display:block!important;max-width:600px!important;">
                        <div style="padding:15px;max-width:600px;margin:0 auto;display:block;">
                         <table bgcolor="#FFFFFF">
                                <tr>
                                    <td><img src="http://bookwhen.epizy.com/bookwhen/images/logo.jpg" height="100" width="150"  /></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table> 
            <table style="width: 100%;">
                <tr>
                    <td style="display:block!important;max-width:600px!important;" bgcolor="#FFFFFF">
                        <div style="padding:15px;max-width:600px;display:block;margin:0 auto;">
                         <table>
                                <tr>
                                    <td style="font-family: Open Sans,arial,sans-serif; font-size:16px;">
                                        <h5 style="font-family: Open Sans,arial,sans-serif; font-size:18px;margin-bottom:10px;">Dear  <?php echo $pic_name; ?></h5>
                                        <p style="font-family: Open Sans,arial,sans-serif; font-size: 14px;margin-bottom:20px;">A request by <?php echo $requester_name; ?> has been submitted.</p>
                                        <p style="font-family: Open Sans,arial,sans-serif; font-size: 14px;margin-bottom:5px;">The request details are:</p>
                                        <p style="margin-bottom: 10px;line-height:1.6;font-family: Open Sans,arial,sans-serif; font-size: 14px;">
                                            Class/Hall : <?php echo $vchroomno; ?><br/>
                                            DateTime-From: <?php echo $dtfrom; ?><br/>
                                            DateTime-To: <?php echo $dtto; ?><br/>
                                        </p>
                                        <br/>
                                        <p style="margin-bottom: 10px;line-height:1.6;font-family: Open Sans,arial,sans-serif; font-size: 16px;">
                                           The request is waiting for you immediate action.
                                        </p>
                                        <p style="margin-bottom: 10px;line-height:1.6;font-family: Open Sans,arial,sans-serif; font-size: 16px;">
                                           Thanks & Regards
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>