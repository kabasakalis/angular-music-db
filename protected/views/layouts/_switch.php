<?php
/**
 * _switch partial view file.
 *
 * A form to switch layouts and bootswatch skins,for Bootstrap3.
 *
 * @author Spiros Kabasakalis <kabasakalis@gmail.com>
 * @copyright Copyright &copy; Spiros Kabasakalis 2013-
 * @link  InfoWebSphere,http://iws.kabasakalis.gr
 * @link  YiiLab,http://yiilab.kabasakalis.tk
 * @link  Github https://github.com/drumaddict
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package
 * @version 2.0.0
 */

$layout_options = array(
    'jumbotron' => 'Jumbotron',
    'carousel' => 'Carousel',
    'starter-template' => 'Starter Template',
    'jumbotron-narrow' => 'Jumbotron Narrow',
    'justified-nav' => 'Justified Nav',
    'offcanvas' => 'Off Canvas',
);

$bootswatch_options = array(
    'none' => 'None',
    'amelia' => 'Amelia',
    'cerulean' => 'Cerulean',
    'cosmo' => 'Cosmo',
    'cyborg' => 'Cyborg',
    'flatly' => 'Flatly',
    'journal' => 'Journal',
    'readable' => 'Readable',
    'simplex' => 'Simplex',
    'slate' => 'Slate',
    'spacelab' => 'Spacelab',
    'united' => 'United',
);

?>

<form class="form-inline" role="form" method="post" name="switch" id="switch">
    <div class="form-group">
        <label class="control-label" for="layout">Choose Layout</label>
        <select id="layout" name="layout" class="form-control" placeholder="Choose layout">
            <?php foreach ($layout_options as $id => $name) {
                echo (app()->layout == $id) ? '<option value="' . $id . '"   selected="selected" >' . $name . '</option>' :
                    '<option value="' . $id . '">' . $name . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="bootswatch_skin">Choose Bootswatch Skin</label>
        <select id="bootswatch_skin" name="bootswatch_skin" class="form-control" placeholder="Choose bootswatch_skin">

            <?php foreach ($bootswatch_options as $id => $name) {
                echo (app()->params->bootswatch3_skin == $id) ? '<option value="' . $id . '"   selected="selected" >' . $name . '</option>' :
                    '<option value="' . $id . '">' . $name . '</option>';
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-default btn-primary">Change Looks!</button>
</form>


