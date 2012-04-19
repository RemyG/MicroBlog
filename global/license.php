<div class="content">

<p>This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.</p>

<p>This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Lesser General Public License for more details.</p>

<p>You should have received a copy of the GNU Lesser General Public License
along with this program.  If not, see <?php echo htmlentities("<http://www.gnu.org/licenses/>"); ?>.</p>

<p>
<a href="javascript:showHideGPL()">See GPL</a><br/>
<a href="javascript:showHideLGPL()">See LGPL</a>
</p>

<pre id="GPL" style="font-family:Monospace; background-color: white; font-size:11px; padding-left: 30px; display: none;">

<?php include "./COPYING"; ?>

</pre>

<pre id="LGPL" style="font-family:Monospace; background-color: white; font-size:11px; padding-left: 30px; display: none;">

<?php include "./COPYING.LESSER"; ?>

</pre>

</div>

<script type="text/javascript">

	function showHideGPL() {
	
		if(document.getElementById('GPL').style.display == 'none') {
			$('#GPL').slideDown();
			$('#LGPL').hide();
		} else {
			$('#GPL').slideUp();
		}
	
	}

	function showHideLGPL() {
		
		if(document.getElementById('LGPL').style.display == 'none') {
			$('#LGPL').slideDown();
			$('#GPL').hide();
		} else {
			$('#LGPL').slideUp();
		}
	
	}

</script>