<!-- search box-->

<TABLE width="100%" border='0' style="border: #4c4c4c 1px solid;">
    <TR>
	<TD align="center">
	<?php 
		echo '<a class="linkhd" href="/users/search/A">A</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/B">B</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/C">C</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/D">D</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/E">E</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/F">F</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/G">G</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/H">H</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/I">I</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/J">J</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/K">K</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/L">L</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/M">M</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/N">N</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/O">O</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/P">P</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/Q">Q</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/R">R</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/S">S</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/T">T</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/U">U</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/V">V</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/W">W</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/X">X</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/Y">Y</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search/Z">Z</a>&nbsp;';
                echo '<a class="linkhd" href="/users/search">All</a>&nbsp;';
	?>
	  </TD>
	</TR>
	<FORM action="/users/search" METHOD="post" name="searchform" > 
	<tr>
	    <td align="left" nowrap>
		Search:
		<INPUT TYPE="text" class="tf" name="searchkeyworld" value=''>
			<select name="what">
				<option value="all">All Fields</option>
				<option value="category">Category</option>
				<option value="comp">Joke</option>
				<option value="singer">Performer</option>
				<option value="ringtone">Ringtone</option>
			</select>
			<INPUT name="search" class="submit_btn" type="submit" value='Search'>
		</td>
    </tr>
	</form>
</TABLE>
<!--Search box end-->