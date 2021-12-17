<?php

namespace Drupal\os2web_newsletter\Form;

/**
 * @file
 * Contains \Drupal\os2web_newsletter\Form\SettingsForm.
 */

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * OS2Web Newsletter settings form.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * Name of the config.
   *
   * @var string
   */
  public static $configName = 'os2web_newsletter.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'os2web_newsletter_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [SettingsForm::$configName];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['all_news_url'] = [
      '#type' => 'textfield',
      '#title' => t('URL for News ALL link'),
      '#description' => t('This URL will be used as News ALL link'),
      '#default_value' => $this->config(SettingsForm::$configName)
        ->get('all_news_url'),
    ];

    $form['all_events_url'] = [
      '#type' => 'textfield',
      '#title' => t('URL for Events ALL link'),
      '#description' => t('This URL will be used as Events ALL link'),
      '#default_value' => $this->config(SettingsForm::$configName)
        ->get('all_events_url'),
    ];

    return parent::buildForm($form, $form_state);
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    $config = $this->config(SettingsForm::$configName);
    foreach ($values as $key => $value) {
      $config->set($key, $value);
    }
    $config->save();

    parent::submitForm($form, $form_state);
  }

}
