<?php
namespace Drupal\siteinfo_modding\Form;

// Classes referenced in this class:
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

// We are extending the site information form
use Drupal\system\Form\SiteInformationForm;

/**
 * Configure site information settings for this site.
 */
class SiteInformationModifiedForm extends SiteInformationForm {
    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)    {
        // Retrieve the system.site configuration
        $site_config = $this->config('system.site');

        // Get the original form from the class we are extending
        $form = parent::buildForm($form, $form_state);
        $siteapikey_value = $site_config->get('siteapikey');
        // Add a textarea to the site information section of the form for our
        // description
        $form['site_apikey'] = [
          '#type' => 'details',
          '#title' => t('Site API Key'),
          '#open' => TRUE,
        ];

        $form['site_apikey']['siteapikey'] = [
          '#type' => 'textfield',
          '#title' => t('Site API Key'),
          // The default value is the new value we added to our configuration
          // in step 1
          '#default_value' => isset($siteapikey_value) ? $siteapikey_value : "No API Key Yet",
          '#description' => $this->t('This the API Key of the site'),
        ];
    
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)    {
       
        $this->config('system.site')
           ->set('siteapikey', $form_state->getValue('siteapikey'))
           ->save();

         \Drupal::messenger()->addMessage(t('The form value has been saved'), 'message');  

        // Pass the remaining values off to the original form that we have extended,
        // so that they are also saved
        parent::submitForm($form, $form_state);
    }
}
