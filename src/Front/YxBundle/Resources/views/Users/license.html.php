<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">License</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <script>
            function StoreLicense(){
                var lic = "<?php echo $license; ?>";
                netobj.StoreLicense(lic);
            }


            </script>
            <object id="netobj" classid="clsid:A9FC132B-096D-460B-B7D5-1DB0FAE0C062"></object> 
            <p onLoad="StoreLicense();"></p><br>
            <p>
                <b>License code:</b><input type="text" size=35 id="code" value="<?php echo $user_licenses; ?>">
                <b>
                    <input type="button" onclick="window.clipboardData.setData('Text', document.getElementById('code').value);" value="COPY">
                </b>
            </p>
        <br>
        <div align="left">
            <b>
                1.  Highlight the above code.<br>
                2.  Copy <b><u>or</u></b> right-click then copy the above code.<br>
                3.  Paste it in the Media Usage Rights Acquisition window that comes on the first time you attempt to play the audio clip.
            </b>
        </div>
            
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>