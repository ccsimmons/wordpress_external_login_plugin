<?php
  if (!$exlog_parent_repeater_slug) {
    $exlog_slug = $form_field["field_slug"] . "0";
  } else {
    $exlog_slug = $exlog_parent_repeater_slug . "_" . $form_field["field_slug"] . "0";
  }
?>

<div
  class="option-container repeater <?php if (!$exlog_view_builder_in_repeater) echo "exlog-repeater-master"; ?>"
  data-exlog-conditionals="<?php echo htmlspecialchars(json_encode($form_field["conditionals"])); ?>"
  data-exlog-field-slug="<?php echo $exlog_slug; ?>"
  xmlns="http://www.w3.org/1999/html">
  <h4><?php echo $form_field["field_name"]; ?></h4>
  <p><?php echo $form_field["field_description"]; ?></p>

  <?php if (!(exlog_is_wpconfig_option_set($form_field["field_slug"]))) : ?>
    <input
      style="background-color: red;"
      class="exlog_repeater_data_store"
      type="hidden"
      name="<?php echo $form_field["field_slug"]; ?>"
      <?php if (!$exlog_parent_repeater_slug) : ?>
        value="<?php echo base64_encode(get_option($form_field["field_slug"])); ?>"
      <?php endif; ?>
    >

    <section class="repeater_item" data-exlog-repeater-id="0">
      <div class="repeater_item_input_container">
        <?php Exlog_view_building::render_field_views($form_field["repeater_fields"], $form_field["slug"]); ?>
      </div>
      <input class="button button-primary delete_repeater_item" value="X" type="button">
    </section>

    <div class="add_more">
      <p class="description">Click to add:</p>
      <input class="exlog_repeater_add_button button button-primary" type="button" value="+"/>
    </div>
  <?php else : ?>
      <?php include EXLOG_PATH_PLUGIN_VIEWS . "/partials/wpconfig_option_set_message.php"?>
  <?php endif; ?>
</div>
