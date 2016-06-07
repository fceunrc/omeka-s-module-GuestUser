<?php
namespace GuestUser\Site\Navigation\Link;
use Omeka\Site\Navigation\Link\LinkInterface;
use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Stdlib\ErrorStore;

class Login implements LinkInterface
{
    public function getLabel()
    {
        return 'Login'; // @translate
    }

    public function getFormTemplate()
    {
        return 'common/navigation-link-form/login';
    }

    public function isValid(array $data, ErrorStore $errorStore)
    {
        if (!isset($data['label'])) {
            $errorStore->addError('o:navigation', 'Invalid navigation: login link missing label');
            return false;
        }
        return true;
    }

    public function toZend(array $data, SiteRepresentation $site)
    {
        return [
            'label' => $data['label'],
            'route' => 'site/resource',
                'class' => 'loginlink',
            'params' => [
                'site-slug' => $site->slug(),
                'controller' => 'guestuser',
                'action' => 'login',
            ],
        ];
    }

    public function toJstree(array $data, SiteRepresentation $site)
    {
        $label = isset($data['label']) ? $data['label'] : $sitePage->title();
        return [
            'label' => $label,
        ];
    }
}
