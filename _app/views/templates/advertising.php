<?php
// Hide this for now.
if ("A" == "b") {
// Display advertising unless a signed in member has a Paid Membership.
//if ($this->session->userdata('member_membership_level') != 'Paid Membership') {
?>

	<div class="container">
		<div class="row">
			<div class="col col-md-12">

				<div>
					<div class="alert alert-danger fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>ADVERTISING WILL GO HERE</h4>
						<p>I'm thinking about adding this to the top of every page unless a member pays an annual fee.</p>
						<p class="margin-top-20"><small>To prevent advertising being displayed on every page CLICK HERE and buy an annual membership to the site.</small></p>
					</div>
				</div>

				<div>
					<div class="alert alert-info fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>ADVERTISING WILL GO HERE</h4>
						<p>More advertising.</p>
					</div>
				</div>			

			</div><!-- end of - col col-md-12 -->
		</div><!-- end of - row -->	
	</div><!-- end of - container -->

<?php
}
?>