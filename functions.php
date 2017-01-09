<?php
//**
//PASTE TEH FOLLOWING CODES IN YOUR CHILD THEME FUNCTIONS.PHP
//***
add_action('category_add_form_fields', 'ac_custom_header_color_field', 10, 2);
function ac_custom_header_color_field()
{
?>
    <div class="form-field">
        <label for="term_meta[cust_header_bg]"><?php
    _e('Category Header Background Color', 'pt');
?></label>
        <input placeholder="#666666" type="text" name="term_meta[cust_header_bg]" id="term_meta[cust_header_bg]" value="">
       
    </div>
<?php
}
add_action('category_edit_form_fields', 'ac_custom_header_color_meta_field', 10, 2);
function ac_custom_header_color_meta_field($term)
{
    $cat_id    = $term->term_id;
    $term_meta = get_option("taxonomy_$cat_id");
?>
    <tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[cust_header_bg]"><?php
    _e('Category Header Background Color', 'pt');
?></label></th>
        <td>
            <input placeholder="#666666" type="text" name="term_meta[cust_header_bg]" id="term_meta[cust_header_bg]" value="<?php
    echo esc_attr($term_meta['cust_header_bg']) ? esc_attr($term_meta['cust_header_bg']) : '';
?>">
           
        </td>
    </tr>
<?php
}
add_action('edited_category', 'ac_custom_header_color_field_save', 10, 2);
add_action('create_category', 'ac_custom_header_color_field_save', 10, 2);
function ac_custom_header_color_field_save($term_id)
{
    if (isset($_POST['term_meta'])) {
        $cat_id    = $term_id;
        $term_meta = get_option("taxonomy_$cat_id");
        $cat_keys  = array_keys($_POST['term_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_meta'][$key])) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        update_option("taxonomy_$cat_id", $term_meta);
    }
}
function checking()
{
    $cat      = get_the_category();
    $cat_id   = $cat[0]->term_id;
    $cat_data = get_option("taxonomy_$cat_id");
    if (isset($cat_data['cust_header_bg'])) {
        $color = $cat_data['cust_header_bg'];
        printf('<style>#main-header{background: %1$s;}</style>', $color);
    }
}
add_action('wp_head', 'checking');
