<?php
namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class LocaleRewriteListener
 */
class LocaleRewriteListener implements EventSubscriberInterface
{
    /**
     * @var routeCollection \Symfony\Component\Routing\RouteCollection
     */
    private $routeCollection;

    /**
     * @var array
     */
    private $supportedLocales;

    /**
     * LocaleRewriteListener constructor.
     *
     * @param RouterInterface $router           Router
     * @param array           $supportedLocales Supported locales
     */
    public function __construct(
        RouterInterface $router,
        array $supportedLocales = array('en')
    ) {
        $this->routeCollection = $router->getRouteCollection();
        $this->supportedLocales = $supportedLocales;
    }

    /**
     * Check that locale supported
     *
     * @param string $locale Locale
     *
     * @return bool
     */
    public function isLocaleSupported($locale)
    {
        return in_array($locale, $this->supportedLocales);
    }

    /**
     * Redirect if rout do not contain lang
     *
     * @param GetResponseEvent $event Event
     *
     * @return void
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $path = $request->getPathInfo();
        $route_exists = false;
        foreach ($this->routeCollection as $routeObject) {
            $routePath = $routeObject->getPath();
            if ($routePath == "/{_locale}" . $path) {
                $route_exists = true;
                break;
            }
        }

        if ($route_exists === true) {
            $locale = $request->getPreferredLanguage();
            if ($locale == "" || $this->isLocaleSupported($locale) === false) {
                $locale = $request->getDefaultLocale();
            }
            $event->setResponse(new RedirectResponse("/" . $locale . $path));
        }
    }

    /**
     * Subscribe to Event
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
        );
    }
}