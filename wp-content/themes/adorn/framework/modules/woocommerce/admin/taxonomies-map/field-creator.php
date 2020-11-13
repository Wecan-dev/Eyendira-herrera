<?php
namespace Adorn\Modules\Woo\FieldCreator;

class SelectField{


	public function __construct() {}

	public function renderField($name, $title, $options, $default_value = false){ ?>

		<div class="form-field">

			<label style="margin-bottom: 10px;display: block" for="<?php echo esc_attr($name);?>">
				<?php echo esc_attr($title);?>
			</label>

			<select name="<?php echo esc_attr($name);?>" id="<?php echo esc_attr($name);?>">

				<?php foreach ( $options as $key => $value ) {
					$selected = '';
					if($default_value === $key){
						$selected = 'selected';
					}

					?>
					<option value="<?php echo esc_attr( $key ) ?>" <?php echo esc_attr($selected);?> >
						<?php echo esc_attr( $value ) ?>
					</option>
				<?php } ?>

			</select>

		</div>

	<?php }

}


class InputField{


	public function __construct() {}

	public function renderField($name, $title, $default_value = ''){ ?>

        <div class="form-field">

            <label style="margin-bottom: 10px;display: block" for="<?php echo esc_attr($name);?>">
				<?php echo esc_attr($title);?>
            </label>

            <input type="text" name="<?php echo esc_attr($name);?>" id="<?php echo esc_attr($name);?>" value="<?php echo esc_attr($default_value);?>"/>

        </div>

	<?php }

}