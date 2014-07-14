<div class="container">

	<?php
	// If a message has been set then display it.
	if ($this->session->flashdata("message") !== FALSE) {
		echo '<div class="row">' . chr(10);
			echo '<div class="col col-md-12">' . chr(10);
				echo '<div class="alert ' . $this->session->flashdata("message_class") . '">' . $this->session->flashdata("message") . '</div>' . chr(10);
			echo '</div><!-- end of - col col-md-12 -->' . chr(10);
		echo '</div><!-- end of - row -->' . chr(10);
	}
	?>


	<div class="row">
		<div class="col col-md-12">

			<h4 class="page_title"><?php echo $title; ?></h4>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->

	<div class="row">	
		<div class="col col-xs-12 col-sm-3 col-lg-3">

			<?php
			$image_properties = array(
			          'src' => base_url(MEMBER_PHOTOS_PATH . $member->profile_photo),
			          'alt' => 'My Profile Photo',
			          'class' => 'img-responsive img-rounded',
			          'width' => '200',
			          'height' => '200',
			          'title' => 'Profile Photo',
			);

			echo img($image_properties) . chr(10);
			?>

		</div><!-- end of - col col-sm-3 -->
		<div class="col col-xs-12 col-sm-9 col-lg-9">

			<?php
			$label_class = 'col-xs-12 col-sm-4 col-md-3 col-lg-3 detail_label';
			$content_class = 'col-xs-12 col-sm-8 col-md-9 col-lg-9';

			echo '<div class="detail_section">' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . ' first">Name:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $member->first_name . ' ' . $member->last_name . '</p>' . chr(10);
				echo '</div>' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Email Address:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $member->email . '</p>' . chr(10);
				echo '</div>' . chr(10);	
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Status:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $member->status . '</p>' . chr(10);
				echo '</div>' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Access:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $member->access . '</p>' . chr(10);
				echo '</div>' . chr(10);		
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Joined:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . dateAndTimeFormattedForDisplayLongVersionWithDayName($member->created_at) . '</p>' . chr(10);
				echo '</div>' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Signed In:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $member->sign_in_count . ' times</p>' . chr(10);
				echo '</div>' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Last Signed In:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . dateAndTimeFormattedForDisplayLongVersionWithDayName($member->last_sign_in_at) . '</p>' . chr(10);
				echo '</div>' . chr(10);
				
				echo '<div class="clearfix">' . chr(10);
					echo '<div class="pull-right margin-top-10">' . chr(10);

						echo '<div>';
							echo '<a href="' . site_url('members/edit-profile') . '" class="btn btn-primary btn-sm">Edit Profile</a>';
							//echo '<span class="padding-right-10"></span>';
							//echo '<a id="go-back" href="#" class="btn btn-danger btn-sm">Cancel</a>';
						echo '</div>' . chr(10);
					
					echo '</div>' . chr(10);
				echo '</div>' . chr(10);
				
			echo '</div>' . chr(10);																
			?>

		</div><!-- end of - col col-sm-9 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->