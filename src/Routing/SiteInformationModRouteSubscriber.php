<?php

namespace Drupal\siteinfo_modding\Routing;

// Classes referenced in this class.
use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class SiteInformationModRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    // Change form for the system.site_information_settings route
    // to Drupal\describe_site\Form\DescribeSiteSiteInformationForm
    // First, we need to act only on the system.site_information_settings route.
    if ($route = $collection->get('system.site_information_settings')) {

      // Next, we need to set the value for _form to the form we have created.
      $route->setDefault('_form', 'Drupal\siteinfo_modding\Form\SiteInformationModifiedForm');
    }
  }

}
