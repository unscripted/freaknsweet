<?php
/*
Template Name: Contact Page
*/
?>

<?php 
if( of_get_option('contact_email') ):
$contactEmail = of_get_option('contact_email');
else:
$contactEmail = get_option('admin_email');
endif;

if( of_get_option('contact_subject') ):
$contactSubject = of_get_option('contact_subject');
else:
$contactSubject = 'ShowyCase';
endif;

if(isset($_POST['submitted'])):
	
	// NAME CHECHING
	if(trim($_POST['contactName']) === '') {
	$nameError = __('You forgot to enter your name.', 'premitheme');
	$hasError = true;
	} else {
	$name = trim($_POST['contactName']);
	}
	
	// EMAIL CHECHING
	if(trim($_POST['email']) === '')  {
	$emailError = __('You forgot to enter your email address.', 'premitheme');
	$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+.[A-Z]{2,4}$", trim($_POST['email']))) {
	$emailError = __('You entered an invalid email address.', 'premitheme');
	$hasError = true;
	} else {
	$email = trim($_POST['email']);
	}
	
	// MESSAGE CHECHING
	if(trim($_POST['comments']) === '') {
	$commentError = __('You forgot to enter your comments.', 'premitheme');
	$hasError = true;
	} else {
	if(function_exists('stripslashes')) {
	$comments = stripslashes(trim($_POST['comments']));
	} else {
	$comments = trim($_POST['comments']);
	}
	}
	
	// IF EVERYTHING IS OK
	if(!isset($hasError)):
		
		$emailTo = $contactEmail;
		$subject = '['.$contactSubject.'] from '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nMessage: $comments";
		$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
		
		mail($emailTo, $subject, $body, $headers);
		
		$emailSent = true;
		
	endif;
endif;
?>

<?php get_header();?>
	
	<section id="content-wrap">
		<div id="main">
			
			<?php the_post(); ?>
			
			<article id="post-<?php the_ID();?>" <?php post_class('entry-wrap');?>>
				
				<?php // SHOW GOOGLE MAP IF SET
				if( of_get_option('google_map') ): ?>
				<div id="contact-map"><?php echo of_get_option('google_map'); ?></iframe>
				</div>
				
				
				<?php // ELSE SHOW FEATURED IMAGE IF SET
				elseif ( has_post_thumbnail()): ?>
				<div class="entry-thumb">
					<?php the_post_thumbnail('fullwidth-page-image'); ?>
				</div>
				<?php endif; ?>
				
				
				<?php // SHOW CONTACT INFO IF SET
				if( of_get_option('contact_address') || of_get_option('contact_phone') || of_get_option('contact_fax') ): ?>
				<div id="contact-info">
					<h2><?php _e('Contact Info', 'premitheme') ?></h2>
					<ul>
						<?php if( of_get_option('contact_address') ): ?>
						<li>
							<span class="label"><?php _e('Address', 'premitheme') ?></span>
							<span><?php echo of_get_option('contact_address'); ?></span>
						</li>
						<?php endif; ?>
						<?php if( of_get_option('contact_phone') ): ?>
						<li>
							<span class="label"><?php _e('Phone', 'premitheme') ?></span>
							<span><?php echo of_get_option('contact_phone'); ?></span>
						</li>
						<?php endif; ?>
						<?php if( of_get_option('contact_fax') ): ?>
						<li>
							<span class="label"><?php _e('Fax', 'premitheme') ?></span>
							<span><?php echo of_get_option('contact_fax'); ?></span>
						</li>
						<?php endif; ?>
					</ul>
				</div>
				<?php endif; ?>
				
				
				<h1 class="entry-title"><?php the_title(); ?></h1>
				
				
				<?php // SHOW CONTENT IF NOT EMPTY
				if(trim($post->post_content) != '' ): ?>
				<div class="entry-content">
					<?php the_content(); ?>
					
					<div class="footer-entry-meta">
					<?php edit_post_link( __( 'Edit', 'premitheme'), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</div>
				<?php endif; ?>
				
				
				<?php // CONTACT FORM
				if(isset($emailSent) && $emailSent == true): ?>
								
				<h2 class="thanks"><?php _e('Thanks, your email was successfully sent', 'premitheme') ?></h2>
				
				<?php else: ?>
				
				<?php if(isset($hasError)): ?>
			    <h2 class="error"><?php _e('There was an error submitting the form', 'premitheme') ?></h2>
				<?php endif; ?>
				
				<form action="<?php the_permalink(); ?>" id="contactf" method="post">
					<p><?php _e('All fields are required', 'premitheme') ?></p>
					
					<p>
						<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required" />
						<label for="contactName"><?php _e('Name', 'premitheme') ?></label>
						<?php if(isset($nameError) && $nameError != '') { ?><em class="error"><?php echo $nameError;?></em><?php } ?>
					</p>
					
					<p>
						<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required email"/>
						<label for="email"><?php _e('Email', 'premitheme') ?></label>
						<?php if(isset($emailError) && $emailError != '') { ?><em class="error"><?php echo $emailError;?></em><?php } ?>
					</p>
					
					<p>
						<textarea name="comments" id="commentsText" rows="8" cols="45" class="required"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
						<?php if(isset($commentError) && $commentError != '') { ?><em class="error"><?php echo $commentError;?></em><?php } ?>
					</p>
					
					<p>
						<input type="hidden" name="submitted" id="submitted" value="true" />
						<button type="submit"><?php _e('Send', 'premitheme') ?></button>
					</p>
				</form>
				<?php endif; ?>
				<div class="clear"></div>
			</article>
			
			<div class="clear"></div>
			
		</div><!-- #main -->
		
<?php get_footer();?>