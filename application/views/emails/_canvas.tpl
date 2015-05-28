<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=320, target-densitydpi=device-dpi">
        <{assign var="color1" value="#C1402A"}>
        <{assign var="color2" value="#1BA3D7"}>
        <{include file="_styles.tpl"}>
    </head>
    <body>
        <table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table">
            <tbody><tr>
                    <td align="center" bgcolor="#ececec">
                        <table class="w640" style="margin:0 10px;" width="640" cellpadding="0" cellspacing="0" border="0">
                            <tbody><tr><td class="w640" width="640" height="20"></td></tr>
                                    <{*
                                    <tr>
                                    <td class="w640" width="640">
                                    <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#a30234">
                                    <tbody><tr>
                                    <td class="w15" width="15"></td>
                                    <td class="w325" width="350" valign="middle" align="left">
                                    <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                                    <tbody><tr><td class="w325" width="350" height="8"></td></tr>
                                    </tbody></table>
                                    <div class="header-content">
                                    </div>
                                    <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                                    <tbody><tr><td class="w325" width="350" height="8"></td></tr>
                                    </tbody></table>
                                    </td>
                                    <td class="w30" width="30"></td>
                                    <td class="w255" width="255" valign="middle" align="right">
                                    <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                                    <tbody><tr><td class="w255" width="255" height="8"></td></tr>
                                    </tbody></table>
                                    <table cellpadding="0" cellspacing="0" border="0">
                                    <tbody><tr>



                                    </tr>
                                    </tbody></table>
                                    <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                                    <tbody><tr><td class="w255" width="255" height="8"></td></tr>
                                    </tbody></table>
                                    </td>
                                    <td class="w15" width="15"></td>
                                    </tr>
                                    </tbody></table>

                                    </td>
                                    </tr>
                                    <tr>
                                    <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" height="20" style="height: 20px;">&nbsp;</td>
                                    </tr>
                                    *}>
                                <tr>
                                    <td id="header" class="w640" width="640" align="left" bgcolor="#ffffff">
                                        <div align="left" style="text-align: left">
                                            <a href="<{config_item('site_url')}>">
                                                <img id="customHeaderImage" label="Header Image" width="548" height="178" src="<{assets_email('images/logo_salon_aquarelle.jpg')}>?<{$smarty.now}>" class="w640" border="0" align="top" style="display: inline">
                                            </a>
                                        </div>


                                    </td>
                                </tr>

                                <tr><td class="w640" width="640" height="30" bgcolor="#ffffff"></td></tr>
                                <tr id="simple-content-row"><td class="w640" width="640" bgcolor="#ffffff">
                                        <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                                            <tbody><tr>
                                                    <td class="w30" width="30"></td>
                                                    <td class="w580" width="580">
                                            <repeater>
                                                <{block name="content"}>

                                                <{/block}>
                                            </repeater>
                                    </td>
                                    <td class="w30" width="30"></td>
                                </tr>
                            </tbody></table>
                    </td></tr>
                <tr><td class="w640" width="640" height="15" bgcolor="#ffffff"></td></tr>

                <tr>
                    <td class="w640" width="640">
                        <table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="<{$color2}>">
                            <tbody><tr><td class="w30" width="30"></td><td class="w580 h0" width="360" height="30"></td><td class="w0" width="60"></td><td class="w0" width="160"></td><td class="w30" width="30"></td></tr>
                                <tr>
                                    <td class="w30" width="30"></td>
                                    <td class="w580" width="360" valign="top">
                                        <p align="left" class="footer-content-left" style="color: #F0F0F0;">
                                            <span><{config_item('soc_name')}></span><br>
                                            <span>
                                                <a href="mailto:<{config_item('email_addr')}>" style="color: #F0F0F0;">
                                                    <font color="#F0F0F0">
                                                    <{config_item('email_addr')}>
                                                    </font>
                                                </a>
                                            </span>
                                        </p>
                                    </td>
                                    <td class="hide w0" width="60"></td>
                                    <td class="hide w0" width="160" valign="top" style="color: #F0F0F0 !important;">
                                        <p id="street-address" align="right" class="footer-content-right" style="color: #F0F0F0 !important;">
                                            <font color="#F0F0F0">
                                            <{nl2br(config_item('contact_addr'))}>
                                            </font>
                                        </p>
                                    </td>
                                    <td class="w30" width="30"></td>
                                </tr>
                                <tr><td class="w30" width="30"></td><td class="w580 h0" width="360" height="15"></td><td class="w0" width="60"></td><td class="w0" width="160"></td><td class="w30" width="30"></td></tr>
                            </tbody></table>
                    </td>
                </tr>
                <tr><td class="w640" width="640" height="60"></td></tr>
            </tbody></table>
    </td>
</tr>
</tbody></table></body></html>
