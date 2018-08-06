<?php
require_once(dirname(__FILE__) . '/lib.php');
echo open_body(array('brown'));
?>
<div class="w3-center w3-white w3-display-middle w3-animate-opacity" style="padding:48px">
	<h1 class="w3-jumbo text-blue">Magivax</h1>
	<p>Magivax is a vaccine schedule generator for physicians.</p>
	<p>Recommendations are based on CDC guidelines.</p><p><a href="#">Learn more</a> or
	<a id="getStarted" href="enterpatientinfo.php" class="w3-button light-blue hover-tan" style="display:inline;margin-left:8px;">Get Started</a></p>
</div>

<div id="color-palette">
	<div class="w3-row">
		<div class="w3-display-container w3-col brown palette"><div class="w3-display-middle">#5D5C61</div></div>
		<div class="w3-display-container w3-col gray palette"><div class="w3-display-middle">#817B82</div></div>
		<div class="w3-display-container w3-col light-blue palette"><div class="w3-display-middle">#7395AE</div></div>
		<div class="w3-display-container w3-col blue palette"><div class="w3-display-middle">#557A95</div></div>
		<div class="w3-display-container w3-col tan palette"><div class="w3-display-middle">#B1A296</div></div>
	</div>
</div>
<script src="magivax.js"></script>
<?php close_body(); ?>