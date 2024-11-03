<h3>Country Information</h3>
<table class="form-table">
	<tr>
		<th><label for="country">Country</label></th>
		<td>
			<input type="hidden" name="country_nonce" value="<?php echo esc_html( wp_create_nonce( 'save_country_meta_action' ) ); ?>" />
			<input type="text" name="country" id="country" value="<?php echo esc_attr( $country ); ?>" class="regular-text" />
			<p class="description">User's country information.</p>
		</td>
	</tr>
</table>