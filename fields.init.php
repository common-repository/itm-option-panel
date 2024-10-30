<?php
/*	
 * @package   ITM Option Panel
 * @author    ITMonks Pvt. Ltd. <admin@itmonks.com>, Rajat Kumar <rajat@w3press.net>
 * @copyright Copyright (c) 2014, ITMonks Pvt. Ltd.
 * @Licence   GPLv2
 */

class ITM_FIELDS extends ITM_FW
{
	public $options;
	/**
     * Start up
     */
    public function __construct()
    {
		$this->options = get_option( 'itmfw_option' );
    }
	/** 
     * Print the Section text
     */
	 
	public function itmfw_text($args)
	{
		if ( $args['desc'] != '' )
				echo '<p>' . $args['label'] . '</p><hr/>';
		 		echo '<span class="description">' . $args['desc'] . '</span>';
		printf(
				'<input type="text" placeholder="Enter '.$args['label'].'" id="'.$args['id'].'" class="'.$args['class'].'" name="itmfw_option['.$args['id'].']" value="%s" />',
				isset( $this->options[''.$args['id'].''] ) ? esc_attr( $this->options[''.$args['id'].'']) : ''
				);
	}
	public function itmfw_select($args)
	{
		if ( $args['desc'] != '' )
			echo '<p>' . $args['label'] . '</p><hr/>';
			echo '<span class="description">' . $args['desc'] . '</span>';
			printf ('<select name="itmfw_option['.$args['id'].']" class="'.$args['class'].'">');
			foreach ($args['choices'] as $value => $label) {
				$sel = ($value == $this->options[''.$args['id'].'']) ? ' selected="selected"' : '';
				printf ("<option value=\"".$value."\"".$sel.">".$label."</option>");
			}
			printf ('</select>');
	}
	
	public function itmfw_upload($args)
	{	
		if ( $args['desc'] != '' )
			echo '<p>' . $args['label'] . '</p><hr/>';
			echo '<span class="description">' . $args['desc'] . '</span>';
			
			echo '<div id="" class="imageWrapper">';
			printf(
					'<input id="up_'.$args['id'].'" type="text" class="upload-url '.$args['class'].'" size="36" name="itmfw_option['.$args['id'].']" placeholder="http://" value="%s" />',
					isset( $this->options[''.$args['id'].''] ) ? esc_attr( $this->options[''.$args['id'].'']) : ''
					);
			echo '<input id="'.$args['id'].'" class="button itmfw_upload_button" type="button" name="upload_button" value="'.$args['label'].'" />';
			
			if($this->options[''.$args['id'].''] != null ){
				echo '<div class="img_prev_'.$args['id'].'" >';
				echo '<img class="itmfw-img" id="itmfw-img-'.$args['id'].'" src="'.$this->options[''.$args['id'].''].'" />';
				echo '<span >
					   <a href="javascript:;" class="remove" id="'.$args['id'].'"  title="Remove image"><i class="fa fa-times"><!-- --></i></a>
					  </span>';
				echo '</div>';
			}else{
				echo '<div class="img_prev_'.$args['id'].'" style="display:none;">';
				echo '<img class="itmfw-img" id="itmfw-img-'.$args['id'].'" src="'.$this->options[''.$args['id'].''].'" />';
				echo '<span>
					   <a href="javascript:;" class="remove" id="'.$args['id'].'" title="Remove image"><i class="fa fa-times"><!-- --></i></a>
					  </span>';
				echo '</div>';
			}
			echo '</div>';
	}
	
	
	public function itmfw_switch($args)
	{
			if ( $args['desc'] != '' )
			echo '<p>' . $args['label'] . '</p><hr/>';
			echo '<span class="description">' . $args['desc'] . '</span>';
			
			echo '<input  style="display:none" class="itmfw_'.$args['id'].' '.$args['class'].'"  type="hidden" id="' . $args['id'] . '" name="itmfw_option['.$args['id'].']" value="0" /> ';
				
			echo '<div class="itmfw_switch">';
				echo '<div class="switch">';
					if($this->options[''.$args['id'].''] == '1'){
						echo	'<span class="on onactive" id="'.$args['id'].'">on</span>
								<span class="off" id="'.$args['id'].'">off</span>';
					}elseif($this->options[''.$args['id'].''] == '0'){
						echo	'<span class="on" id="'.$args['id'].'">on</span>
								<span class="off offactive" id="'.$args['id'].'">off</span>';
					}else{
						echo	'<span class="on" id="'.$args['id'].'">on</span>
								<span class="off offactive" id="'.$args['id'].'">off</span>'; 
					}
				echo '</div>';
			echo '</div>';
			
	}
	
	public function itmfw_radio($args)
	{
			if ( $args['desc'] != '' )
			echo '<p>' . $args['label'] . '</p><hr/>';
			echo '<span class="description">' . $args['desc'] . '</span>';
			
				$i=1;
			foreach($args['choices'] as $value => $label){
			
				echo '<input  type="radio"  name="itmfw_option['.$args['id'].']" class="'.$args['class'].'" 
				value="'.esc_attr( $value ).'" ' . checked( $this->options[''.$args['id'].''], $value , false ) . '/>
					<label for="' . $args['id'] . $i . '">' . $label . '</label> <br/>';
				$i++;
			}
	}
	
	public function itmfw_checkbox($args)
	{
		if ( $args['desc'] != '' )
		echo '<p>' . $args['label'] . '</p><hr/>';
		echo '<span class="description">' . $args['desc'] . '</span>';
		
		echo '<input  type="checkbox" id="' . $args['id'] . '" class="'.$args['class'].'" name="itmfw_option['.$args['id'].']" value="1" ' . checked( $this->options[''.$args['id'].''], 1, false ) . ' /> ' . $args['label'] . '';
	}
	
	public function itmfw_textarea($args)
	{
			if ( $args['desc'] != '' )
			echo '<p>' . $args['label'] . '</p><hr/>';
			echo '<span class="description">' . $args['desc'] . '</span>';
			
			echo '<textarea name="itmfw_option['. $args['id'] .']" class="'.$args['class'].'" placeholder="' . $std . '" rows="10" cols="45">' . wp_htmledit_pre( $this->options[''.$args['id'].''] ) . '</textarea>';
	}
	
	public function itmfw_colorpicker($args)
	{
			if ( $args['desc'] != '' )
			echo '<p>' . $args['label'] . '</p><hr/>';
			echo '<span class="description">' . $args['desc'] . '</span>';
			
			echo '<div class="colorSelector" id="'.$args['id'].'-color">
				  <div class="'.$args['id'].'" style="background-color: '.$this->options[''.$args['id'].''].'"></div>';
			echo '<input name="itmfw_option['. $args['id'] .']" type="text"  placeholder="#ffffff" id="col_'.$args['id'].'" value="'.$this->options[''.$args['id'].''].'" class="col_'.$args['id'].' itmfw_colorbox"  maxlength="6" size="6" />';
			echo '</div>'; 
			
			echo "
				<script>
					jQuery(document).ready(function($) {
						$('#".$args['id']."-color').ColorPicker({
							color: '#0000ff',
							onShow: function (colpkr) {
								$(colpkr).fadeIn(500);
								return false;
							},
							onHide: function (colpkr) {
								$(colpkr).fadeOut(500);
								return false;
							},
							onChange: function (hsb, hex, rgb) {
								$('#".$args['id']."-color div').css('backgroundColor', '#' + hex);
								$('.col_".$args['id']."').val('#' + hex);
							}
						});
					});
				</script>
			";
	}
/*	
 * @package   ITM Option Panel
 * @author    ITMonks Pvt. Ltd. <admin@itmonks.com>, Rajat Kumar <rajat@w3press.net>
 * @copyright Copyright (c) 2014, ITMonks Pvt. Ltd.
 * @Licence   GPLv2
 */
}

