<?php /**
 * @package Love Motto Widget
 * @version 1.07
 */
/*
Plugin Name: Love Motto Widget
Plugin URI: http://www.be2.com/be2/international.html
Author: BE2
Version: 1.07
Author URI: http://www.be2.com/be2/international.html
Description: Show that Love means something to you - this plugin rotates love quotes, very nice design.
*/

function love_motto_widget_render()
{
    $options = get_option('lovemottowidget');
    $branch = $options['branch'];

    $embed_force_link = '';
    $embed_force_name = '';


    switch ($branch)
    {
        case 'uk':
            $embed_force_link = 'http://www.be2.co.uk';
            $embed_force_name = 'Love &amp; Dating widget by be2';
            break;
        case 'de':
            $embed_force_link = 'http://www.be2.de';
            $embed_force_name = 'Widget by be2 Partnersuche';
            break;
        case 'fr':
            $embed_force_link = 'http://www.be2.fr';
            $embed_force_name = 'Amour widget | be2.fr site de célibataire';
            break;
        case 'br':
            $embed_force_link = 'http://www.be2.com.br';
            $embed_force_name = 'Amor widget | be2.com.br';
            break;
        case 'se':
            $embed_force_link = 'http://www.be2.se';
            $embed_force_name = 'Kärlek widget | be2.se';
            break;
        case 'it':
            $embed_force_link = 'http://www.be2.it';
            $embed_force_name = 'Amore widget | be2.it';
            break;
        case 'dk':
            $embed_force_link = 'http://www.be2.dk';
            $embed_force_name = 'Kærlighed widget | be2.dk dating';
            break;
        case 'es':
            $embed_force_link = 'http://www.be2.es';
            $embed_force_name = 'Amor widget | be2.es';
            break;
        case 'nl':
            $embed_force_link = 'http://www.be2.nl';
            $embed_force_name = 'Liefde widget | be2.nl dating';
            break;
        default:
            $embed_force_link = 'http://www.be2.com/be2/international.html';
            $embed_force_name = 'Love &amp; Dating Widget by be2';
            break;
    }

    echo '<li id="love_motto_widget">';

    if (trim($options['widget_title']) != '')
    {
        echo '<h2 class="widget-title">' . htmlspecialchars($options['widget_title']) . '</h2>';
    }

    echo '<div align="center">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash2/cabs/swflash.cab#version=4,0,0,0" ID="lovemottowidget" width="' . $options['width'] . '" height="' . $options['height'] . '">
<param name="movie" value="' . get_bloginfo('url') . '/wp-content/plugins/lovemottowidget/lovemottowidget.swf' . ($branch != '' ? '?branch=' . $branch : '') . '">
<param name="bgcolor" value="#FFFFFF">
<param name="quality" value="high">
<embed src="' . get_bloginfo('url') . '/wp-content/plugins/lovemottowidget/lovemottowidget.swf' . ($branch != '' ? '?branch=' . $branch : '') . '" 
quality="high"  
bgcolor="#FFFFFF" 
width="' . $options['width'] . '" 
height="' . $options['height'] . '" 
type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></embed></object>
  <br />
       <a href="' . $embed_force_link . '" target="_blank">
            ' . $embed_force_name . '
       </a>
       
       </div><br /></li>';
}

function love_motto_widget_register()
{
    return 'test';
}

add_action('init', 'love_motto_widget_register');

function love_motto_widget_control()
{
    $options = $newoptions = get_option('lovemottowidget');
    if (isset($_POST['lovemottowidget-submit']) && $_POST["lovemottowidget-submit"])
    {
        $newoptions['widget_title'] = strip_tags(stripslashes($_POST["lovemottowidget-widget_title"]));
        $newoptions['branch'] = strip_tags(stripslashes($_POST["lovemottowidget-branch"]));
        $newoptions['width'] = (int)$_POST["lovemottowidget-width"];
        $newoptions['height'] = (int)$_POST["lovemottowidget-height"];


    }

    if ($newoptions['width'] == 0)
    {
        $newoptions['width'] = 362;
    }

    if ($newoptions['height'] == 0)
    {
        $newoptions['height'] = 210;
    }

    if ($options != $newoptions)
    {
        $options = $newoptions;
        update_option('lovemottowidget', $options);
    }


    $title = htmlspecialchars($options['widget_title'], ENT_QUOTES);
    $width = (int)$options['width'];
    $height = (int)$options['height'];
    $branch = $options['branch'];

    $branch_list = '<option value="">Default</option>';
    $branch_list_s = '            uk,      de,     fr,     br,     se,    it,      dk,    es,          nl';
    $branch_list_b = 'United Kingdom, Germany, France, Brazil, Sweden, Italy, Denmark, Spain, Netherlands';

    $branch_list_s = explode(',', $branch_list_s);
    $branch_list_b = explode(',', $branch_list_b);

    reset($branch_list_s);
    while (list($key, $val) = each($branch_list_s))
    {
        $branch_list = $branch_list . '<option value="' . trim($val) . '"' . ($branch == trim($val) ? ' selected="selected"' : '') . '>' . htmlspecialchars(strtoupper(trim($val)) . ' - ' . trim($branch_list_b[$key])) . '</option>';
    } ?>
                <p><b>Plugin rotates love quotes</b></p>
				<p><label for="lovemottowidget-title"><?php _e('Title:'); ?> <input style="width: 220px;" id="lovemottowidget-widget_title" name="lovemottowidget-widget_title" type="text" value="<?php echo $title; ?>" /></label></p>
			   	<p><label for="lovemottowidget-width"><?php _e('Width:'); ?> <input style="width: 220px;" id="lovemottowidget-width" name="lovemottowidget-width" type="text" value="<?php echo $width; ?>" /></label></p>
				<p><label for="lovemottowidget-height"><?php _e('Height:'); ?> <input style="width: 220px;" id="lovemottowidget-height" name="lovemottowidget-height" type="text" value="<?php echo $height; ?>" /></label></p>
				<p><label for="lovemottowidget-branch"><?php _e('Branch:'); ?> <select style="width: 220px;" id="lovemottowidget-branch" name="lovemottowidget-branch"><?php echo $branch_list; ?></select></p>
                <input type="hidden" id="lovemottowidget-submit" name="lovemottowidget-submit" value="1" />
	<?php }

if (function_exists('wp_register_sidebar_widget'))
{
    wp_register_sidebar_widget('lovemottowidget', 'Love Motto Widget', 'love_motto_widget_render', null, 'lovemotto');
    wp_register_widget_control('lovemottowidget', 'Love Motto Widget', 'love_motto_widget_control', null, 75, 'lovemotto');
}
else
{
    register_sidebar_widget('Love Motto Widget', 'love_motto_widget_render', null, 'lovemotto');
    register_widget_control('Love MottoWidget', 'love_motto_widget_control', null, 75, 'lovemotto');
} ?>
