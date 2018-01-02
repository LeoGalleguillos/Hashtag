<?php
namespace LeoGalleguillos\Hashtag;

use LeoGalleguillos\Hashtag\Model\Service as HashtagService;
use LeoGalleguillos\Hashtag\Model\Table as HashtagTable;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'aliases' => [
                ],
                'factories' => [
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                HashtagService\Hashtag::class => function ($serviceManager) {
                    return new HashtagService\Hashtag(
                        $serviceManager->get(HashtagTable\Hashtag::class)
                    );
                },
                HashtagTable\Hashtag::class => function ($serviceManager) {
                    return new HashtagTable\Hashtag(
                        $serviceManager->get('hashtag')
                    );
                },
            ],
        ];
    }
}
