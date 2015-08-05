<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @subpackage cerulean
 * @since cerulean 4.0
 */
global $responsive_svg;
?>

<?php if (!empty(get_field_img($responsive_svg['img_field']))){ ?>
        <?php 
        $path = get_attached_file(get_field($responsive_svg['img_field']) ); 
        $file = file_get_contents($path); 
        preg_match('/viewBox="[0-9\s]+"/i', $file, $viewbox);
        $viewbox = explode(' ', $viewbox[0]) ;
        $ratio = floor($viewbox[3] / $viewbox[2] *10000) /100;
        //var_dump($ratio);
        $file = preg_replace('/<svg.+(viewBox="[0-9\s]+").+>/i', '<svg version="1.1" preserveAspectRatio="xMinYMin meet" class="u-svg__content" $1>', $file);
        
        ?>
        <div class="u-svg <?php echo $responsive_svg['class_svg-container'];?>" <?php echo $responsive_svg['attr_svg-container'];?> style="padding-bottom:<?php echo $ratio; ?>%">
        <?php 
        echo $file;
        ?>
        </div>
<?php } ?>