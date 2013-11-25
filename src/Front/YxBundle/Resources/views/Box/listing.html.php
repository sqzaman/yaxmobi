<script src="<?php echo $view['assets']->getUrl('web/jokes/js/jquery-1.7.min.js') ?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $view['assets']->getUrl('web/jokes/js/jquery.tablesorter.js') ?>" type="text/javascript" charset="utf-8"></script>
<script >

   
   
    var JQ7=jQuery.noConflict();
	JQ7(document).ready(function(){
    JQ7(document).on('click', '#chkAll', function() {
        JQ7(".chk").prop("checked",JQ7("#chkAll").prop("checked"))
    }) 
});
   

 

var JQ9=jQuery.noConflict();
function onSubmit() 
{ 
    var fields = JQ9("input[name='checking[]']").serializeArray(); 
    if (fields.length == 0) 
    { 
        alert('Please select a joke to purchase.'); 
        // cancel submit
        return false;
    } 
    else 
    { 

    }
}

// register event on form, not submit button
JQ9('#frm1').submit(onSubmit)

function openPlayer(songname, folder) {
    var targetURL = '<?php echo $view['router']->generate('checkingcategory') ?>?c='+songname; 
    $.ajax(targetURL)
        .done(function (data) {
        var boolValue = data == 'true'; // converts the string to a bool
        if (boolValue) {
            if (folder != '') {
                folderURL = "/" + folder;
            } else {
                folderURL = '';
            }
            var url = "/users/player1/" + songname + folderURL;
   
            window.open(url, 'mywin', 'left=20,top=20,width=800,height=440');
        } else {

            alert('you should click on a subcategory first');

        }
    })
        .fail(function () {
        // failed
    });
}
</script>
<style>
 #offer_image_selected{ 
display: none;
}
#offer_image:hover #offer_image_selected{
display : block;
}
</style>
<div  class="category-content">
    
    <div class="category-header"> 
         <?php $search = array("_", "\'");
               $result   = array(" ", "'"); ?>
        <h1><?php echo str_replace($search,$result,strtoupper($cat));  ?> - <?php echo str_replace($search,$result,strtoupper($subcat)); ?></h1>
    </div>
         
<?php if($rs||$rs!==false){ ?>
<div class="listing-txt" >
<form name="frm1" id="frm1" method="post" action="<?php echo $view['assets']->getUrl('/songs/addtocart')?>" >
<div style="height:472px;width:470px;overflow:scroll;overflow-x:hidden;overflow-y:scroll;" >
<table width="100%" cellspacing="1" cellpadding="2" border="0" id="category-table" class="tablesorter">
<thead>
<tr>
    <?php if($cat == 'long_jokes' || $cat=='yo_mama' || $cat== 'videos' || $cat== 'cartoons') : ?>

    <td class="td-color" width="15%" >Preview</td>
    <th width="17%" >Joke</th>
    <th width="16%" >Duration</th>
    <td class="td-color" width="12%" >Credit(s)</td>
    <td class="td-color" width="36%" >Action</td> 
    <td class="checkall" width="8%" ><input type="checkbox" id="chkAll" /> </td>
    <?php endif; ?>
    <?php if($cat == 'short_jokes') : ?>
    <td class="td-color" width="15%" >Preview</td>
    <th width="17%" >Joke</th>
    <th width="16%" >Price</th>
    <td class="td-color" width="12%" >Credit(s)</td>
    <td class="td-color" width="36%" >Action</td> 
    <td class="checkall" width="8%" ><input type="checkbox" id="chkAll" /> </td>
    <?php endif; ?>


</tr>
</thead>   
<tbody>
    <?php $count = 0;
    foreach ($rs as $pendingSong) : ?>
   <tr id="offer_image" id="console" class="<?php echo (++$count%2 ? "true" : "no-true") ?>" valign="top" >
        <td>
            <a href='javascript:void();' onClick="openPlayer('<?php echo $pendingSong['id']; ?>','')">
                <img class="img_prev" border="0" align="absmiddle" src="<?php echo $view['assets']->getUrl('/web/jokes/images/Play-Icon.png') ?>"></a>&nbsp;&nbsp;
        </td>
        <?php if($cat == 'long_jokes' || $cat=='yo_mama' || $cat== 'videos' || $cat== 'cartoons') : ?>
        <td width="350"><?php echo $pendingSong['composition']; ?></td>
        <td><?php echo $pendingSong['duration']; ?></td>
        <?php endif; ?>
        <?php if($cat == 'short_jokes') : ?>
        <td width="350"><?php echo $pendingSong['title']; ?></td>
        <td><?php echo $pendingSong['price']; ?></td>
        <?php endif; ?>
        <td style="text-align: center;">2</td>
        <!--<td id="offer_image"></td>-->
        <td >
            <div id="offer_image_selected" ><a target="_blank" href="<?php echo $view['assets']->getUrl('/songs/addtocart') ?>?checking=<?php echo $pendingSong['id']; ?>"><img class="add_to_cart" border="0" title="Add to Cart" src="<?php echo $view['assets']->getUrl('/web/jokes/images/add_to_cart.png') ?>"></a><a target="_blank" class="add-p-l" href="<?php echo $view['assets']->getUrl('/#song-' . $pendingSong['id']) ?>"><img class="add_to_wishlist" border="0" title="Add to wishlist" src="<?php echo $view['assets']->getUrl('/web/jokes/images/add_to_wishlist.png') ?>"></a><a target="_blank" class="add-p-l" href="<?php echo $view['assets']->getUrl('/tellafriends/add/'.$pendingSong['id']) ?>"><img class="share" border="0" title="Share" src="<?php echo $view['assets']->getUrl('/web/jokes/images/share.png') ?>"></a></div>
        </td>
        <td ><input type="checkbox" value="<?php echo $pendingSong['id']; ?>" class="chk"  name="checking[]"/></td>
  </tr>
  <?php endforeach; ?>
  <tr><div class="page-nav"><?php echo $pager->renderFullNav(); ?></div>
      <a href="#" id="add_view" ><img  alt="Add to Playlist" src="<?php echo $view['assets']->getUrl('/web/jokes/images/view_cart.png')?>"></a>
      <div id="add_cart" ><input class="submit" name="submit" type="submit"  value="" ></div>
  </tr>
</tbody>              
</table>
</div>
</form>
    <script>
        
         var JQ8=jQuery.noConflict();
    	JQ8(document).ready(function(){
    JQ8("#category-table").tablesorter();
    });
    </script>
</div>
<?php
 }else{
	echo '<div class="listing-no-record"><h1>No records found!</h1></div>';
}
 ?>
</div>