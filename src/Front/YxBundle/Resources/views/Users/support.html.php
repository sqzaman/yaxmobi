<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Support</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <?php
                $temp = $view['session']->getFlash('notice');
                
                if ( $temp ):
                    //$t = $view['session']->getFlash('notice');
                    //$t[0];
                    echo '<div id="flash-message">' . $temp[0] . '</div>';
                endif;
            ?>
            <p>Please send us your question, and our support staff will respond within 1 business days.</p>
            <form method="post" action="/users/support">
                <table>
                    <tr>
                        <td>Name</td>
                        <td>
                            <?php echo $view['form']->widget($form['name']) ?>
                            <?php echo $view['form']->errors($form['name']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <?php echo $view['form']->widget($form['email']) ?>
                            <?php echo $view['form']->errors($form['email']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td>
                            <?php echo $view['form']->widget($form['subject']) ?>
                            <?php echo $view['form']->errors($form['subject']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>
                            <?php echo $view['form']->widget($form['body']) ?>
                            <?php echo $view['form']->errors($form['body']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <?php echo $view['form']->widget($form['_token']) ?>
                            <input type="submit" class="submit_btn" value="Contact Support">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td valign='top'>
				<div id="inline_image">
                                    <a href="/users/faq">
                                        <img src="/img/faq.gif" />
                                    </a>
				</div>
                                <br>
                                <a href="/users/faq">Check out our FAQs</a>
			</td>
                    </tr>
                    
                </table>
            </form>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>